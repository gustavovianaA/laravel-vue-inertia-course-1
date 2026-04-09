<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;

class SitePagesController extends Controller
{
    public function home()
    {

        $categories = Category::select('id', 'name')->limit(10)->get();
        return Inertia::render('Frontend/Home', [
            'categories' => $categories
        ]);
    }

    public function about()
    {
        return Inertia::render('Frontend/About', [
            'title' => 'About us Page',
        ]);
    }
}
