<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeController
{
    public function index()
    {
        return view('stripe');
    }

    public function stripePost(Request $request)
    {
        $stripe = new StripeClient(config('services.secret_key'));
        $token = $stripe->tokens->create([
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => '5',
                'exp_year' => '2026',
                'cvc' => '314',
            ],
        ]);
    }

    public function stripeGet()
    {

    }
}
