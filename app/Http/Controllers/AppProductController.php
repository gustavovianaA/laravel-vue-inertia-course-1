<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;

class AppProductController extends Controller
{
    protected $defaultCover = Product::DEFAULT_COVER;

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('id', 'name', 'price', 'cover')->get();
        return Inertia::render('App/Product/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return Inertia::render('App/Product/Create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:5000'
        ]);

        //Cover image upload
        if ($request->hasFile('cover')) {
            $coverName = '/storage/' . $request->file('cover')
                ->store('product_covers', 'public');
        } else {
            $coverName = $this->defaultCover;
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'cover' => $coverName,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('app.products.index')
            ->with('message', 'Produto Cadastrado com Sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('App/Product/Show', [
            'product' => $product->load('category')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return Inertia::render('App/Product/Edit', [
            'product' => $product->load('category'),
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:5000'
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id
        ];

        //Cover image upload
        if ($request->hasFile('cover')) {
            $coverName = '/storage/' . $request->file('cover')
                ->store('product_covers', 'public');
            $data['cover'] = $coverName;

            if($product->cover != $this->defaultCover)
                Storage::disk('public')->delete($product->cover);
        }

        $product->update($data);

        return redirect()->route('app.products.show', $product)
            ->with('message', 'Produto Alterado com Sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('app.products.index')
            ->with('message', 'Produto Deletado com Sucesso.');
    }

    public function search(Request $request)
    {
        $name = $request->name;

        $products = Product::where('name', 'like', "%$name%")->get();

        return Inertia::render('App/Product/Index', [
            'products' => $products
        ]);
    }
}
