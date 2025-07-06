<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      return view('index');
    }

    public function getContact(){
      return view('index');
    }


    public function getAbout(){
      return view('index');
    }
}
