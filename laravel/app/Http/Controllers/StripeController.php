<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\EmailSenderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Stripe\StripeClient;
use Stripe\Exception\CardException;

class StripeController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Товар из вашей корзины только что купили!');
        }

        $cartIds = array_keys($cart);
        $totalPrice = collect($cart)->sum('price');

        $active = Product::with('user')
            ->whereIn('id', $cartIds)
            ->where('status', 0)
            ->get();

        if(count($active) !== count($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Товар из вашей корзины только что купили!');
        }

        Product::whereIn('id', $cartIds)->update(['status' => 1]);
        Cache::flush();
        return view('pages.account.payment', compact('totalPrice'));
    }

    public function stripePost(Request $request)
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
          return redirect()->route('cart.index');
        }

        $cartIds = array_keys($cart);
        $totalPrice = collect($cart)->sum('price');
        $orderNumber = now()->format('YmdHis') . auth()->id();
        $statusOrder = 0;

        try {
            $stripe = new StripeClient(config('services.stripe.secret_key'));
            $token = $request->input('stripeToken');

            $charge = $stripe->charges->create([
                'amount' => $totalPrice * 100,
                'currency' => 'byn',
                'source' => $token,
                'description' => "Оплата заказа № " . $orderNumber,
            ]);

            $statusOrder = 1;

            $product = Product::with('user')
                ->whereIn('id', $cartIds)
                ->get();

            Product::whereIn('id', $cartIds)->update([
                'status' => 2,
                'order_number' => $orderNumber,
            ]);

            foreach ($product as $item) {
                EmailSenderService::sendBuyProductMail($item);
            }

            session()->forget('cart');
            Cache::flush();

            return redirect()->route('cart.index')->with('success', 'Оплата прошла успешно!');

        } catch (CardException $e) {

            Product::whereIn('id', $cartIds)->update(['status' => 0]);
            $statusOrder = 0;

            $messages = [
                'insufficient_funds' => 'На карте недостаточно средств!',
                'card_declined' => 'Карта была отклонена!',
                'expired_card' => 'Срок действия карты истек!',
                'incorrect_cvc' => 'Неверный CVC-код!',
                'processing_error' => 'Произошла ошибка при обработке карты!',
            ];

            $err = $e->getError();
            $code = $err->code;
            $message = $messages[$code] ?? 'Ошибка карты: ' . $e->getMessage();

            return back()->with('error', $message);

        } catch (Exception $e) {

            Product::whereIn('id', $cartIds)->update(['status' => 0]);
            $statusOrder = 0;

            return back()->with('error', 'Системная ошибка: ' . $e->getMessage());

        } finally {
            Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'order_number' => $orderNumber,
                'status' => $statusOrder,
            ]);
        }
    }
}
