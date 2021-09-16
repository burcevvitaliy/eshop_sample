<?php

use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\OrderController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\ProductListController;
use App\Http\Controllers\Shop\ReportController;
use App\Http\Controllers\Shop\ShoppingCartController;
use Illuminate\Support\Facades\Route;

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
Route::group(
  [
      'prefix' => '/',
      //'as' => 'shop.',
      'namespace' => 'Shop',
  ],
  function () {
    Route::get('/', [CategoryController::class, 'showCategories']);
    Route::get('/subcategory/{id}', [CategoryController::class, 'showSubcategories']);
    Route::get('/productlist/{id}', [ProductListController::class, 'showProductList']);
    Route::post('/productlist/{id}', [ProductListController::class, 'getProductList']);

    Route::get('/product/{id}', [ProductController::class, 'show']);

    Route::get('/shoppingcart/show',[ShoppingCartController::class, 'show']);
    Route::post('/shoppingcart/add',[ShoppingCartController::class, 'add']);
    Route::post('/shoppingcart/changeitemcount', [ShoppingCartController::class, 'changeItemCount']);
    Route::post('/shoppingcart/remove',[ShoppingCartController::class, 'remove']);

    Route::get('/order/prepareorder',[OrderController::class, 'prepareOrder']);
    Route::post('/order/makeorder',[OrderController::class, 'makeOrder']);


    Route::get('/makeorderreport',[ReportController::class, 'makeorderreport']);
});

//Route::get('/', function () {
    
    /*
    1 - M
    $subcategories = Category::find(1)->subcategories;

    $result = $subcategories->first()->category;

    $subcat = Subcategory::find(1);
    $result = $subcat->category;
    */

  //  return view('shop.categories');
//});

