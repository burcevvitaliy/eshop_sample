<?php

namespace App\Http\Controllers;

use App\Events\OrderSent;
use App\Services\OrderService;
use App\Services\ShoppingCartService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function prepareOrder(ShoppingCartService $shoppingCartService, Request $request)
    {
        $shopping_cart_items = $shoppingCartService->showShoppingCart($request->session()->getId());

        return view('shop.order', [
            'shopping_cart_items' => $shopping_cart_items
        ]);
    }

    public function makeOrder(Request $request, OrderService $orderService)
    {
        $order_data = $request->all();

        $order = $orderService->makeOrder($request->session()->getId(), $order_data);

        OrderSent::dispatch($order);
    }
}
