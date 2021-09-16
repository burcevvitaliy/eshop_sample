<?php 

namespace App\Services;

use App\Repository\Eloquent\OrderItemRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\Eloquent\ShoppingCartItemRepository;
use App\Repository\OrderItemRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\ShoppingCartItemRepositoryInterface;

class OrderService
{
    private $shoppingCartItemRepository;
    private $orderRepository;

    public function __construct(ShoppingCartItemRepositoryInterface $shoppingCartItemRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->shoppingCartItemRepository = $shoppingCartItemRepository;
        $this->orderRepository = $orderRepository;
    }

    public function makeOrder($session_id, $order_data)
    {
        $shopping_cart_items = $this->shoppingCartItemRepository->getItems($session_id);

        return $this->orderRepository->createOrder($session_id, $shopping_cart_items, $order_data);
    }
}
