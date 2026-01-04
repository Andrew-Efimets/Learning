<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Stripe\Exception\CardException;

class StripeController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = collect($cart)->sum('price');
        return view('pages.account.payment', compact('totalPrice'));
    }

    public function stripePost(Request $request)
    {
        $totalPrice = collect(session()->get('cart', []))->sum('price');
        $orderNumber = now()->format('YmdHis') . auth()->id();
        $status = 0;

        try {
            $stripe = new StripeClient(config('services.stripe.secret_key'));
            $token = $request->input('stripeToken');

            $charge = $stripe->charges->create([
                'amount' => $totalPrice * 100,
                'currency' => 'byn',
                'source' => $token,
                'description' => "Оплата заказа № " . $orderNumber,
            ]);

            $status = 1;

            session()->forget('cart');

            return redirect()->route('cart.index')->with('success', 'Оплата прошла успешно!');

        } catch (CardException $e) {
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
            $status = 0;

            return back()->with('error', $message);

        } catch (Exception $e) {
            $status = 0;

            return back()->with('error', 'Системная ошибка: ' . $e->getMessage());

        } finally {
            Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'order_number' => $orderNumber,
                'status' => $status,
            ]);
        }
    }
}
