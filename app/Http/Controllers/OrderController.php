<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\ShoppingCartService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function prepareOrder(ShoppingCartService $shoppingCartService, Request $request)
    {
        $items = $shoppingCartService->showShoppingCart($request->session()->getId());

        
    }

    public function makeOrder(Request $request, OrderService $orderService)
    {
        $order_data = [
            'name' => 'Vitos',
            'email' => 'vitos@gmail.com',
        ];

        $orderService->makeOrder($request->session()->getId(), $order_data);
    }
}
