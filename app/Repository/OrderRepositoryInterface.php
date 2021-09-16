<?php 

namespace App\Repository;

/**
* Interface OrderRepositoryInterface
* @package App\Repositories
*/
interface OrderRepositoryInterface
{
    public function createOrder($session_id, $shopping_cart_items, $order_data);
}
