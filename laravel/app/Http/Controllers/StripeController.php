<?php

namespace App\Http\Controllers;

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
        try {
            $stripe = new StripeClient(config('services.stripe.secret_key'));
            $token = $request->input('stripeToken');
            $totalPrice = collect(session()->get('cart', []))->sum('price');
            $charge = $stripe->charges->create([
                'amount' => $totalPrice * 100,
                'currency' => 'usd',
                'source' => $token,
                'description' => "Оплата заказа",
            ]);

            return redirect()->route('cart.index')->with('success', 'Оплата прошла успешно!');

        } catch (CardException $e) {
            $messages = [
                'insufficient_funds' => 'На карте недостаточно средств',
                'card_declined' => 'Карта была отклонена',
                'expired_card' => 'Срок действия карты истек',
                'incorrect_cvc' => 'Неверный CVC-код',
                'processing_error' => 'Произошла ошибка при обработке карты',
            ];

            $err = $e->getError();
            $code = $err->code;
            $message = $messages[$code] ?? 'Ошибка карты: ' . $e->getMessage();

            return back()->with('error', $message);

        } catch (Exception $e) {
            return back()->with('error', 'Системная ошибка: ' . $e->getMessage());
        }
    }
}
