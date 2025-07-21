<?php

namespace App\Http\Controllers\produect;
use App\Models\{Category,Product};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class filter extends Controller
{
    public function index(){
          $categories = Category::all();

        return view('filter.filter',compact('categories'));
    }

    public function filterProducts(Request $request)
    {
        $query = Product::query();

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('price_min') && $request->price_min != '') {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max') && $request->price_max != '') {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $products = $query->get();

        return view('filter.filtered_products', compact('products'));
    }
    
}