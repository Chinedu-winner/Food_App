<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MealController extends Controller{
    public function index(){
        $meals = Meal::all();
        return view('meal', compact('meals'));
    }
}
