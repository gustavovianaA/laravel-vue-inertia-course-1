<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;

class AppDashboardController extends Controller
{
    public function index()
    {

        $products = Product::get();
        $categories = Category::get();
        return Inertia::render('App/Dashboard', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
