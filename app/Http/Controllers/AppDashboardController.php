<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class AppDashboardController extends Controller
{
    public function index()
    {

        $products = Product::select('id', 'name', 'price')->get();
        $categories = Category::select('id','name')->get();
        
        $cards = [
            [
                'id' => 1,
                'title' => 'Produtos',
                'number' => $products->count()
            ],
            [
                'id' => 2,
                'title' => 'Categorias',
                'number' => $categories->count()
            ],
            [
                'id' => 3,
                'title' => 'Usuários',
                'number' => User::count()
            ]
        ];
        
        return Inertia::render('App/Dashboard', [
            'products' => $products,
            'categories' => $categories,
            'cards' => $cards
        ]);
    }
}
