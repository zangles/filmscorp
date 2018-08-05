<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Route::get('/azs', function () {
    $product = \App\Product::find(1);
    dd($product->property[0]->pivot->value);
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('sales', 'SalesController');
    Route::get('/search', 'SearchController@index')->name('search');
    Route::post('/search', 'SearchController@result')->name('search.result');
});

