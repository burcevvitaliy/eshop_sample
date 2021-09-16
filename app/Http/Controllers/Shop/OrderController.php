<?php

namespace App\Http\Controllers\Shop;

use App\Events\OrderSent;
use App\Http\Requests\MakeOrderRequest;
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

    public function makeOrder(MakeOrderRequest $request, OrderService $orderService)
    {
        $order_data = $request->validated();

        $order = $orderService->makeOrder($request->session()->getId(), $order_data);
      
        OrderSent::dispatch($order);
        return response()->json(['status' => true, 'message' => 'ok', 'result' => []]);
    }
}
