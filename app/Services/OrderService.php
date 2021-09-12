<?php 

namespace App\Services;

use App\Repository\Eloquent\OrderItemRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\Eloquent\ShoppingCartItemRepository;

class OrderService
{
    private $shoppingCartItemRepository;
    private $orderRepository;
    private $orderItemRepository;

    public function __construct(ShoppingCartItemRepository $shoppingCartItemRepository, OrderRepository $orderRepository, OrderItemRepository $orderItemRepository)
    {
        $this->shoppingCartItemRepository = $shoppingCartItemRepository;
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function makeOrder($session_id, $order_data)
    {
        $shopping_cart_items = $this->shoppingCartItemRepository->getItems($session_id);

        $this->orderRepository->createOrder($session_id, $shopping_cart_items, $order_data);

    }
}
