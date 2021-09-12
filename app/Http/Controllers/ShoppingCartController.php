<?php

namespace App\Http\Controllers;

use App\Services\ShoppingCartService;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function show(ShoppingCartService $shoppingCartService, Request $request)
    {
        $shopping_cart_items = $shoppingCartService->showShoppingCart($request->session()->getId());

        return view('shop.shopping_cart', [
            'shopping_cart_items' => $shopping_cart_items
        ]);
    }

    public function add(ShoppingCartService $shoppingCartService, Request $request)
    {
        $params = $request->all();
        $product_id = $params['product_id'] ?? 0;
     
        $shoppingCartService->addItem($request->session()->getId(), $product_id);
    }

    public function changeItemCount(ShoppingCartService $shoppingCartService, Request $request)
    {
        $params = $request->all();
        $count = $params['count'] ?? 1;
        $product_id = $params['product_id'] ?? 0;
 
        $shoppingCartService->changeItemCount($request->session()->getId(), $product_id, $count);
    }

    public function remove(ShoppingCartService $shoppingCartService, Request $request)
    {
        $params = $request->all();
        $shoppingCartService->removeItem($request->session()->getId(), $params['product_id'] ?? 0);
    }
}
