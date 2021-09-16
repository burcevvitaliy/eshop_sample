<?php 

namespace App\Repository;

/**
* Interface ProductRepositoryInterface
* @package App\Repositories
*/
interface ShoppingCartItemRepositoryInterface
{
    public function findByProductIdAndShoppingCartId($product_id, $shopping_cart_id);

    public function getItems($session_id);

    public function removeItem($session_id, $product_id);

    public function getCountItemsInCart($session_id);
}
