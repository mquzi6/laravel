<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $popularProducts = Product::orderBy('rating', 'desc')->take(4)->get();
        $newProducts = Product::orderBy('created_at', 'desc')->take(4)->get();
        
        return view('home', compact('popularProducts', 'newProducts'));
    }
}