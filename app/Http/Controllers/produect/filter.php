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
    
}
