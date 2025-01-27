<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\SubscriptionHestory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    public function payment(Subscription $subscription)
    {
        // Set your Stripe secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $subscription->price * 100;
        $name = $subscription->title;
        $currency = 'inr';
        $payment_method_types = ['card'];
        $user_id = Auth::id();
        try {
            // dd($subscription);
            // Create a new Stripe session
            $session = Session::create([
                'payment_method_types' => $payment_method_types,
                'line_items' => [[
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => [
                            'name' => $name,
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.fail') . '?session_id={CHECKOUT_SESSION_ID}',
                'metadata' => [
                    'subscription' => $subscription,
                    'user_id' => $user_id,
                ],
            ]);

            return redirect()->to($session->url);
        } catch (ApiErrorException $e) {
            return redirect()->route('payment.fail')->withErrors(['message' => 'Payment processing failed.']);
        }
    }

    // public function paymentSuccess(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     $sessionId = $request->input('session_id');

    //     try {
    //         $session = Session::retrieve($sessionId);

    //         $metadata = $session->metadata;
    //         $user_id = $session->metadata->user_id;
    //         $subscription = json_decode($metadata->subscription);

    //         $data = [
    //             'subscription_id' => $subscription->id,
    //             'subscribe_date' => now(),
    //             'is_subscribe' => '1',
    //             'updated_at' => now(),
    //         ];

    //         $userData = User::find($user_id)->update($data);

    //         $addHestory = SubscriptionHestory::create([
    //             'user_id' => $user_id,
    //             'contact' => $userData->contact,
    //             'subscription_id' => $subscription->id,
    //         ]);

    //         $request->session()->put('is_subscribe', 1);
    //         $request->session()->put('subscription', $subscription);

    //         return redirect()->route('front.home');
    //     } catch (ApiErrorException $e) {
    //         // Handle error
    //         return redirect()->route('payment.fail')->withErrors(['message' => 'Payment processing failed.']);
    //     }
    // }

    public function paymentSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->input('session_id');

        try {
            $session = Session::retrieve($sessionId);

            $metadata = $session->metadata;
            $user_id = $metadata['user_id']; // Access metadata directly as an array

            $subscription = json_decode($metadata['subscription']);
            // dd($subscription);

            $data = [
                'subscription_id' => $subscription->id,
                'subscribe_date' => now(),
                'is_subscribe' => 1, // Ensure this is an integer for database compatibility
                'updated_at' => now(),
            ];

            // Update user's subscription status
            User::find($user_id)->update($data);

            // Create subscription history record
            SubscriptionHestory::create([
                'user_id' => $user_id,
                'subsciption_id' => $subscription->id,
                'amount' => $subscription->price,
            ]);

            // Store subscription data in session
            $request->session()->put('is_subscribe', 1);
            $request->session()->put('subscription', $subscription);

            return redirect()->route('front.home');
        } catch (ApiErrorException $e) {
            // Handle error
            return redirect()->route('payment.fail')->withErrors(['message' => 'Payment processing failed.']);
        }
    }


    // public function paymentSuccess(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     $sessionId = $request->input('session_id');

    //     try {
    //         $session = Session::retrieve($sessionId);

    //         $metadata = $session->metadata;
    //         $user_id = $session->metadata->user_id;
    //         $subscription = json_decode($metadata->subscription);

    //         $data = [
    //             'subscription_id' => $subscription->id,
    //             'subscribe_date' => now(),
    //             'is_subscribe' => '1',
    //             'updated_at' => now(),
    //         ];

    //         User::find($user_id)->update($data);

    //         $request->session()->put('is_subscribe', 1);
    //         $request->session()->put('subscription', $subscription);

    //         return redirect()->route('front.home');
    //     } catch (ApiErrorException $e) {
    //         // Handle error
    //         return redirect()->route('payment.fail')->withErrors(['message' => 'Payment processing failed.']);
    //     }
    // }

    public function paymentFail(Request $request)
    {

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->input('session_id');

        $session = Session::retrieve($sessionId);

        $metadata = $session->metadata;
        $user_id = $session->metadata->user_id;

        $subscription = json_decode($metadata->subscription);

        $request->session()->put('is_subscribe', 0);
        $request->session()->put('subscription', $subscription);
        $request->session()->put('user', User::find($user_id));

        return redirect()->route('front.home');
    }
}
