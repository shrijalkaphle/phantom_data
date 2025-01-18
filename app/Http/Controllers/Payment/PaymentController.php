<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\Checkout\Session as StripeSession;

use Stripe\Subscription;

class PaymentController extends Controller
{
    public function handleGet()
    {
        return view('payment');
    }

    public function handlePost(Request $request)
    {
        //dd($request->all());
        $userData=DB::table('users')->where('email',$request->card_holder_email)->first();
        //dd($userData);
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create a customer
            $customer = \Stripe\Customer::create([
                'name' => $request->card_holder_name,
                'email' => $request->card_holder_email,
                'source' => $request->stripeToken,
            ]);

            // Charge the customer
            $charge = \Stripe\Charge::create([
                "amount" => $request->total_amount * 100, // amount in cents
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => "Test payment from Laravel app",
            ]);

            $contactInfo = [
                'email' => $request->card_holder_email,
                'payment_id' => $request->stripeToken,
                'obtained_credits' => $request->obtained_credits,
                'amount' => $request->total_amount,
                'current_total_credits' => $request->obtained_credits,
                'coupon_id' => $request->coupon_id ? $request->coupon_id : 0,
                'transaction_status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('transactions')->insert($contactInfo);
            if ($userData) {
                $update_user_credits = [
                    'credit' => $userData->credit + $request->obtained_credits,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                DB::table('users')->where('id', $userData->id)->update($update_user_credits);
                $update_transaction = [
                    'current_total_credits' => $userData->credit + $request->obtained_credits,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $latest_transaction = DB::table('transactions')->where('email', $userData->email)->latest('created_at')->first();
                DB::table('transactions')
                    ->where('id', $latest_transaction->id)
                    ->update($update_transaction);
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment successful!',
                'charge' => $charge,
                'obtained_credits'=>$request->obtained_credits,
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage()
            ], 500);
        }
    }







    // ---------------------------- MONTHLY SUBSCRIPTION ------------------------------//





    public function handleSubscription(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));
    
    try {
        $user_email=$request->card_holder_email;
    $user=DB::table('users')->where('email',$user_email)->first();
        $subscription_id=$request->subscription_id;
        // Check if the user already has an active subscription
        $existingSubscription = DB::table('transactions')
            ->where('email', $request->card_holder_email)
            ->where('payment_id',$subscription_id)
            ->latest('created_at')
            ->first();

        if ($existingSubscription && $existingSubscription->payment_id) {
            $subscription = \Stripe\Subscription::retrieve($existingSubscription->payment_id);
            if ($subscription->status === 'active' || $subscription->status === 'trialing') {
                $subscription->cancel(); // Call cancel on the subscription instance
            }
            $update_old_transaction = [
                'monthly_subscription' =>0,
                'subscription_status' => 0,
                'updated_at' => now(),
            ];
            DB::table('transactions')->where('payment_id', $existingSubscription->payment_id)->update($update_old_transaction);


        }

        // Create a new customer or retrieve existing one
        $customer = \Stripe\Customer::create([
            'name' => $request->card_holder_name,
            'email' => $request->card_holder_email,
            'source' => $request->stripeToken,
        ]);

        // Create a new subscription
        $subscription = \Stripe\Subscription::create([
            'customer' => $customer->id,
            'items' => [
                [
                    'price' => $request->price_id, // Use the price ID for the subscription plan
                ],
            ],
            'expand' => ['latest_invoice.payment_intent'],
        ]);

        // Insert the new subscription info into the database
        $contactInfo = [
            'email' => $request->card_holder_email,
            'payment_id' => $subscription->id, // Store the new subscription ID here
            'obtained_credits' => $request->obtained_credits,
            'amount' => $subscription->latest_invoice->amount_due / 100, // Convert from cents
            'current_total_credits' => $request->obtained_credits,
            'coupon_id' => $request->coupon_id ? $request->coupon_id : 0,
            'transaction_status' => 1, 
            'monthly_subscription' => 1,
            'subscription_status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('transactions')->insert($contactInfo);

        if ($user) {
            // Update user credits
            $update_user_credits = [
                'credit' => $user->credit + $request->obtained_credits,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('users')->where('id', $user->id)->update($update_user_credits);

            $update_transaction = [
                'monthly_subscription' => 1,
                'subscription_status' => 1,
                'current_total_credits' => $user->credit + $request->obtained_credits,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $latest_transaction = DB::table('transactions')
                ->where('email', $user->email)
                ->latest('created_at')
                ->first();
            DB::table('transactions')->where('id', $latest_transaction->id)->update($update_transaction);
        }

        return response()->json([
            'success' => true,
            'message' => 'Subscription created successfully!',
            'subscription' => $subscription,
        ], 200);
    } catch (\Exception $ex) {
        return response()->json([
            'success' => false,
            'error' => $ex->getMessage()
        ], 500);
    }
}

    
    public function createCheckoutSession(Request $request)
    {
    //  /   dd($request->all());
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = auth()->user();
        $previousSubscription = DB::table('transactions')
            ->where('subscription_status', 1)
            ->where('email', $user->email)
            ->where('monthly_subscription', 1)
            ->whereNotNull('payment_id') // Make sure it has a payment ID
            ->latest()
            ->first();
            if ($previousSubscription) {
            try {

                $update_transactions = [
                    'subscription_status' => 0,
                    'monthly_subscription' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                DB::table('transactions')
                    ->where('id', $previousSubscription->id)
                    ->update($update_transactions);

                $stripeSubscription = \Stripe\Subscription::retrieve($previousSubscription->payment_id);
                $stripeSubscription->cancel();
            } catch (\Exception $e) {
                // Handle exceptions or log errors
                return response()->json(['error' => 'Unable to cancel previous subscription: ' . $e->getMessage()], 500);
            }
        }

        // Create a new checkout session
        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $request->stripe_price_id,
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'subscription',
                'success_url' => route('subscription.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('subscription.cancel'),
            ]);

            // Store session details in session
            session([
                'stripe_price_id' => $request->stripe_price_id,
                'obtained_credits' => $request->monthly_obtained_credits,
                'stripe_subscription_id' => $checkout_session->id,
                'amount' => $request->amount,
            ]);

            // Redirect to the checkout URL
            return redirect($checkout_session->url);
        } catch (\Exception $e) {
            // Handle exceptions or log errors
            return response()->json(['error' => 'Unable to create checkout session: ' . $e->getMessage()], 500);
        }
    }






    

    public function subscriptionSuccess(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session_id = $request->get('session_id');
        $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
        $subscription_id = $checkout_session->subscription;
        $obtained_credits = session('obtained_credits');
        $amount = session('amount');


        $contactInfo = [
            'email' => auth()->user()->email,
            'payment_id' => $subscription_id,
            'obtained_credits' => $obtained_credits,
            'amount' => $amount,
            'current_total_credits' => $obtained_credits,
            'coupon_id' => 0,
            'transaction_status' => 1,
            'monthly_subscription' => 1,
            'subscription_status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('transactions')->insert($contactInfo);

        if (Auth::check()) {
            $update_user_credits = [
                'credit' => auth()->user()->credit + $obtained_credits,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('users')->where('id', auth()->user()->id)->update($update_user_credits);
            $update_transaction = [
                'current_total_credits' => auth()->user()->credit + $obtained_credits,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $latest_transaction = DB::table('transactions')->where('email', auth()->user()->email)->latest('created_at')->first();
            DB::table('transactions')
                ->where('id', $latest_transaction->id)
                ->update($update_transaction);
        }
        return redirect()->route('dashboard');
    }


    public function subscriptionCancel(Request $request)
    {
        return view('subscription.cancel');
    }


    public function cancelSubscription(Request $request)
{
    $user_info=DB::table('users')->where('id',$request->email)->first();
    
    Stripe::setApiKey(env('STRIPE_SECRET'));
    $subscriptionId = $request->subscription_id;
    $userEmail = $user_info->email;

    try {
        // Retrieve the subscription
        $stripeSubscription = \Stripe\Subscription::retrieve($subscriptionId);
        
        // Cancel the subscription
        $stripeSubscription->cancel();

        // Retrieve the customer from the subscription
        $customerId = $stripeSubscription->customer;

        // Update the customer's email and name in Stripe
        \Stripe\Customer::update($customerId, [
            'email' => $userEmail,
            'name' => $user_info->name,
        ]);

        // Update the local database
        $update_transactions = [
            'monthly_subscription' => 0,
            'subscription_status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('transactions')
            ->where('email', $userEmail)
            ->where('payment_id', $subscriptionId)
            ->update($update_transactions);

        return redirect()->back()->with('success', 'Subscription cancelled successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to cancel subscription: ' . $e->getMessage());
    }
}

}
