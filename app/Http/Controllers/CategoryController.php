<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryProperty;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryWithValuesResource;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $categorie = factory(Category::class)->create([
            'name' => $request->input('name')
        ]);

        if (!is_null($request->input('property'))) {
            foreach ($request->input('property') as $property) {
                $catProperty[] = factory(CategoryProperty::class)->make([
                    'name' => $property
                ]);
            }

            $categorie->property()->saveMany($catProperty);
        }

        $request->session()->flash('status', 'Categoria creada correctamente');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $category->name = $request->input('name');
        $category->save();


        foreach ($request->input('property') as $property) {
            $id = key($property);
            $name = reset($property);
            if($id == 0) {
                $newProperty = factory(CategoryProperty::class)->make([
                    'name' => $name
                ]);

                $category->property()->save($newProperty);
                $properties[] = $newProperty->id;
            } else {
                $catProperty = CategoryProperty::findOrFail($id);
                $catProperty->name = $name;
                $catProperty->save();
                $properties[] = $catProperty->id;
            }
        }

        CategoryProperty::where('category_id',$category->id)->whereNotIn('id', $properties)->delete();

        $request->session()->flash('status', 'Categoria actualizada correctamente');

        return redirect()->route('categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        $request->session()->flash('status', 'Categoria borrada correctamente');

        return redirect()->route('categories.index');
    }

    public function apiList(Request $request, Category $category)
    {
        return new CategoryResource($category);
    }


}
