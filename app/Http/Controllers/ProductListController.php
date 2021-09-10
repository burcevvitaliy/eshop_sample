<?php

namespace App\Http\Controllers;

use App\Services\FilterService;
use App\Services\ProductListService;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function showProductList($subcategory_id, FilterService $filterService)
    {
    
        $filters = $filterService->getFilters($subcategory_id);

        return view('shop.productlist', [
            'filters' => $filters
        ]);
    } 

    public function getProductList($subcategory_id, ProductListService $productListService, Request $request)
    {
        $params = $request->all();
        $products = $productListService->showProductsWithinSubCategory($subcategory_id, $params);

        return response()->json([
            'products' => $products,
        ]);
    }
}
