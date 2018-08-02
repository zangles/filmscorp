<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryProperty;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\CategoryWithValuesResource;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $category = Category::findOrFail($request->input('category'));
        $product = factory(Product::class)->create([
            'category_id' => $category->id,
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ]);

        foreach ($request->input('property') as $id => $value) {
            $product->property()->attach($id, [
                'value' => $value
            ]);
        }

        $request->session()->flash('status', 'Producto creado correctamente');

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $category_id = $request->input('category');
        $product->category_id = $category_id;

        $product->property()->wherePivot('product_id', $product->id)->detach();

        foreach ($request->input('property') as $id => $value) {
            $product->property()->attach($id, [
                'value' => $value
            ]);
        }

        $product->save();

        $request->session()->flash('status', 'Producto actualizado correctamente');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        $request->session()->flash('status', 'Producto borrado correctamente');

        return redirect()->route('products.index');
    }

    public function apiCategoryProperty(Request $request, Product $product)
    {
        return new CategoryWithValuesResource($product);
    }
}
