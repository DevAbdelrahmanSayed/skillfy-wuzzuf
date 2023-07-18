<?php

namespace App\Http\Controllers;


use App\Mail\PurchaseMail;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class SubscriptionController extends Controller
{

    const WEEKLY_PAYMENT=20;
    const MONTHLY_PAYMENT=80;
    const YEARLY_PAYMENT=200;
    const CURRENCY='usd';

    public function __construct()
    {
        $this->middleware(['auth','verified','employ','paid']);
    }

    public function subscribeCreate()
    {
        return view('subscription.subscribe');
    }
    public function initiatePayment(Request $request)
    {
        $plans=[
            'weekly'=>[
                'name'=>'weekly',
                'description'=>'weekly payment',
                'price'=>self::WEEKLY_PAYMENT,
                'currency'=>self::CURRENCY,
                'quantity'=>1,
            ],
            'monthly'=>[
                'name'=>'monthly',
                'description'=>'monthly payment',
                'price'=>self::MONTHLY_PAYMENT,
                'currency'=>self::CURRENCY,
                'quantity'=>1,
            ],
            'yearly'=>[
                'name'=>'yearly',
                'description'=>'yearly payment',
                'price'=>self::YEARLY_PAYMENT,
                'currency'=>self::CURRENCY,
                'quantity'=>1,
            ]
        ];
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $selectPlan = null;
            if ($request->is('subscribe/payment/weekly')) {
                $selectPlan = $plans['weekly'];
                $billingEnds = now()->addWeek()->startOfDay()->toDateString();
            } elseif ($request->is('subscribe/payment/monthly')) {
                $selectPlan = $plans['monthly'];
                $billingEnds = now()->addMonth()->startOfDay()->toDateString();
            } elseif ($request->is('subscribe/payment/yearly')) {
                $selectPlan = $plans['yearly'];
                $billingEnds = now()->addYear()->startOfDay()->toDateString();
            }

            if ($selectPlan) {
                $successUrl = URL::signedRoute('payment.success', [
                    'plan' => $selectPlan['name'],
                    'billing_ends' => $billingEnds,
                ]);

                $lineItems = [
                    [
                        'price_data' => [
                            'currency' => $selectPlan['currency'],
                            'unit_amount' => $selectPlan['price'] * 100,
                            'product_data' => [
                                'name' => $selectPlan['name'],
                                'description' => $selectPlan['description'],
                            ],
                        ],
                        'quantity' => $selectPlan['quantity'],
                    ],
                ];

                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'success_url' => $successUrl,
                    'cancel_url' => route('payment.cancel'),
                ]);

                return redirect($session->url);
            }
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
    public  function paymentSuccess(Request $request)
    {
        $plan= $request->plan;
        $billingEnds=$request->billing_ends;
        User::where('id',auth()->user()->id)->update([
            'plan'=>$plan,
            'billing_ends'=>$billingEnds,
            'status'=>'paid'
        ]);
        try {
            Mail::to(auth()->user())->queue(new PurchaseMail($plan,$billingEnds));
        }catch (\Exception $e) {
            return response()->json($e);
        }

        return redirect()->route('show.dashboard')->with('successMessage',' payment was successfully');


    }
    public  function paymentCancel()
    {
        return redirect()->route('showDashboard')->with('errorMessage',' payment was un successfully');

    }
}


