<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class AppProductController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('id', 'name', 'price' , 'cover')->get();
        return Inertia::render('App/Product/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('App/Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'cover' => 'nullable|file',
            'description' => 'nullable|string|max:5000'
        ]);

        $coverName = $request->hasFile('cover') ? 
        $request->file('cover')->getClientOriginalName() : 
        '/img/default-product.jpg';

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'cover' => $coverName,
            'description' => $request->description,
            'category_id' => 1
        ]);

        return redirect()->to('/app/products')
            ->with('message', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('App/Product/Show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('App/Product/Edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
        ]);

        $product->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect()->to('/app/products')->with('message', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->to('/app/products')->with('message', 'Product Delete Successfully');
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
