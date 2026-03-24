<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;

class FoodController extends Controller{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $foods = Food::all(); 
        $foods = \App\Models\Food::with('category')->paginate(10);
        return view('admin.foods.index', compact('foods'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.foods.create', compact('categories'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('foods', 'public');
        }

        Food::create($validated);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food created successfully.');
    }

    public function edit($id){
        $food = \App\Models\Food::findOrFail($id);
        return view('admin.foods.edit', compact('food'));
    }

    public function update(Request $request, $id){
        $food = \App\Models\Food::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('foods', 'public');
        }

        $food->update($validated);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food updated successfully.');
    }

    public function destroy(Food $food){ 
        $food->delete();

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food deleted successfully.');
    }
}