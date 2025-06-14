<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeController extends Controller
{
    public function create(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount' => 5000, 
            'currency' => 'myr',
            'payment_method_types' => ['card'],
        ]);

        return response()->json([
            'clientSecret' => $intent->client_secret,
        ]);
    }
}

