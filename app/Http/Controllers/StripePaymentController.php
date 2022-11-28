<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe', compact('data'));
    }

    public function stripeload(Request $request)
    {
        $data['total_amt'] = $request->total_amt;
        $data['order_id'] = $request->order_id;
        return view('stripe', compact('data'));
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => $request->amount,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment"
        ]);
        request()->session()->flash('success', 'Payment successful!, Payment token is: '. $request->stripeToken);


        DB::table('payments')
            ->insert([
                'amount' => $request->amount,
                'mode'  => 1,
                'reference' =>  $request->stripeToken
            ]);

        $latest_payment = DB::table('payments')
            ->orderBy('id', 'desc')
            ->latest()->first();

        DB::table('orders')
            ->where('id', '=', $request->order_id)
            ->update([
                'payment' => $latest_payment->id,
            ]);

        echo $request->order_id . ', ' . $request->amount;
        return redirect(route('frontend.index', 1));
    }
}
