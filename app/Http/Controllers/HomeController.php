<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category,Product};
class HomeController extends Controller
{
    public function index(){
      $categories = Category::all();
      return view('index',compact('categories'));
    }

    public function categoryShow($id){
      $category = Category::findOrFail($id);
      $products = $category->products;
      return "category {$category ->name}";
    }

    public function getContact(){
      return "contact us";
    }


    public function getAbout(){
      return "about us";
    }
}
