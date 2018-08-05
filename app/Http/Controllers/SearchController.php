<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = \App\Category::all();
        return view('search.index', compact('categories'));
    }

    public function result(SearchRequest $request)
    {
        $all = $request->all();

        $query = Product::query();
        $query->select('products.*');
        $query->join('product_category_property','product_category_property.product_id','=','products.id');
        $query->where('category_property_id','=',$request->input('property'));
        $query->where('value','=',$request->input('value'));
        $result = $query->get();

        $categories = \App\Category::all();

        return view('search.index', compact('categories','result'));
    }

}
