<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function showMeal(){
        $food = Food::with('category')->where('status', 'available')->get();
        return view('meal', compact('foods'));
    }
}
