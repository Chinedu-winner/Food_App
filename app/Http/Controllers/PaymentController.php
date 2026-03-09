<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Order;
use Yabacon\Paystack;

class PaymentController extends Controller{
    public function redirectToGateway($id){
        $meal = Meal::findOrFail($id);

        $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));

        try {
            $response = $paystack->transaction->initialize([
                'amount' => $meal->price * 100, 
                'email' => auth()->user()->email,
                'callback_url' => route('payment.callback'),
            ]);

            return redirect($response->data->authorization_url);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function handleCallback(Request $request){
        $reference = $request->query('reference');

        $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));

        try {
            $tranx = $paystack->transaction->verify([
                'reference' => $reference,
            ]);

            if ($tranx->data->status === 'success') {
                // Save order as paid
                Order::create([
                    'user_id' => auth()->id(),
                    'name'    => auth()->user()->name,
                    'food_name' => session('meal_name'),
                    'quantity' => session('meal_quantity'),
                    'price' => session('meal_price'),
                    'total' => session('meal_price'), 
                    'status' => 'paid',
                ]);

                return redirect('/meal')->with('success', 'Payment successful!');
            }
        } catch (\Exception $e) {
            //
        }

        return redirect('/meal')->with('error', 'Payment failed.');
    }
}