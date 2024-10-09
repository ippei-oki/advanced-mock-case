<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => 'Test Product',
                        ],
                        'unit_amount' => 1000,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
            ]);

            return redirect($session->url, 303);
        } catch (\Exception $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
}
