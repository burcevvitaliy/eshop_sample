<?php

use App\Models\Category;
use App\Models\Subcategory;
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

Route::get('/', function () {
    
    /*
    1 - M
    $subcategories = Category::find(1)->subcategories;

    $result = $subcategories->first()->category;

    $subcat = Subcategory::find(1);
    $result = $subcat->category;
    */

    return view('welcome');
});
