<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class AppDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {

        $products = Product::select('id', 'name', 'price')->paginate(10);
        $categories = Category::select('id', 'name')->paginate(10);

        $cards = [
            [
                'id' => 1,
                'title' => 'Produtos',
                'number' => Product::count()
            ],
            [
                'id' => 2,
                'title' => 'Categorias',
                'number' => Category::count()
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
