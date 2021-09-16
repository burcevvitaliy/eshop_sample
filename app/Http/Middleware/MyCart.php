<?php

namespace App\Http\Middleware;

use App\Services\ShoppingCartService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MyCart
{
    private $shoppingCartService;

    public function __construct(ShoppingCartService $shoppingCartService)
    {
        $this->shoppingCartService = $shoppingCartService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('get')) {
            $count_items = $this->shoppingCartService->getCountItems($request->session()->getId());
            View::share('shopping_cart_item_count', $count_items);
        }
        return $next($request);
    }
}
