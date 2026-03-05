<?php
namespace App\Http\Controllers;
use App\Models\Meal;
use Illuminate\Http\Request;

class PaymentController extends Controller{
    public function redirectToGetway($mealId){
        $meal = Meal::findOrFail($mealId);

        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Please login to place an order');
        }
        
        return redirect('/meal')->with('success', 'Order placed successfully for ' . $meal->name . ' ($' . $meal->price . ')');
    }

    public function handleCallback(){
        return redirect('/meal')->with('success', 'Payment processed successfully');
    } 

    public function redirectToGateway($id){
        $meal = Meal::findOrFail($id);
        $user = Auth::user(); 
        return view('payment', compact('meal', 'user'));
        // return "Processing payment for meal ID: " . $id;
    }
}
