<?php
namespace App\Http\Controllers;
use App\Models\Meal; 
use Illuminate\Http\Request;
use Yabacon\Paystack;
use App\Models\Order;

class PaymentController extends Controller{
    public function redirectToGateway(Request $request){
        $mealId = $request->meal_id;
        $meal = Meal::find($mealId);
        $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));

        try {
            $response = $paystack->transaction->initialize([
                'amount' => $meal->price * 100, 
                'email' => auth()->user()->email,
                'callback_url' => route('payment.callback')
            ]);

            return redirect($response->data->authorization_url);
        } catch (\Exception $e) {
            return back()->with('error', 'Error initializing payment.');
        }
    }

    public function handleCallback(Request $request){
        $reference = $request->query('reference');
        $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));

        $tranx = $paystack->transaction->verify([
            'reference' => $reference,
        ]);

        if ($tranx->data->status === 'success') {
            Order::create([
                'customer_name' => auth()->user()->name,
                'food_name' => session('meal_name'),
                'quantity' => 1,
                'price' => session('meal_price'),
                'status' => 'paid',
            ]);
            return redirect('/meal')->with('success', 'Payment successful!');
        }
        return redirect('/meal')->with('error', 'Payment failed.');
    }
}