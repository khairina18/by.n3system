<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentIntentController extends Controller
{
    public function create(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $amount = $request->amount;

        Log::info('Creating PaymentIntent with amount: ' . $amount);

        if (!is_numeric($amount)) {
            return response()->json(['error' => 'Invalid amount'], 400);
        }

        $intent = PaymentIntent::create([
            'amount' => intval($amount), // in cents
            'currency' => 'myr',
            'payment_method_types' => ['card'],
        ]);

        return response()->json([
            'clientSecret' => $intent->client_secret,
        ]);
    }
}
