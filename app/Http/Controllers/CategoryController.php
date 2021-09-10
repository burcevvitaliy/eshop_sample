<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\SubcategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategories(CategoryRepository $categoryRepository, Request $request)
    {
        $request->session()->put('key', 'one');
        $categories = $categoryRepository->showCategoriesForHomePage();

        return view('shop.categories', [
            'categories' => $categories
        ]);
    }

    public function showSubcategories($category_id, SubcategoryRepository $subcategoryRepository)
    {
        $subcategories = $subcategoryRepository->showSubcategories($category_id);

        return view('shop.subcategories', [
            'subcategories' => $subcategories
        ]);
    }
}
