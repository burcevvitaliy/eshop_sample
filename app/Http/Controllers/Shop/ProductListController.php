<?php

namespace App\Http\Controllers\Shop;

use App\Services\FilterService;
use App\Services\ProductListService;
use App\Services\ShoppingCartService;
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

    public function getProductList($subcategory_id, ProductListService $productListService, Request $request, ShoppingCartService $shoppingCartService)
    {
        $params = $request->all();
        $products = $productListService->showProductsWithinSubCategory($subcategory_id, $params);

        $shopping_cart_items = $shoppingCartService->showShoppingCart($request->session()->getId());
        
        $products = $shoppingCartService->markProductsInCart($products, $shopping_cart_items);

        return response()->json([
            'products' => $products,
        ]);
    }
}
