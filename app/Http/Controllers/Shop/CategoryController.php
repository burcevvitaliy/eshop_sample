<?php

namespace App\Http\Controllers\Shop;

use App\Repository\CategoryRepositoryInterface;
use App\Repository\SubcategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategories(CategoryRepositoryInterface $categoryRepository, Request $request)
    {
        $request->session()->put('key', 'one');
        $categories = $categoryRepository->showCategoriesForHomePage();

        return view('shop.categories', [
            'categories' => $categories
        ]);
    }

    public function showSubcategories($category_id, SubcategoryRepositoryInterface $subcategoryRepository)
    {
        $subcategories = $subcategoryRepository->showSubcategories($category_id);

        return view('shop.subcategories', [
            'subcategories' => $subcategories
        ]);
    }
}
