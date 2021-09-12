<?php

namespace App\Repository\Eloquent;

use App\Models\ShoppingCartItem;
use Illuminate\Support\Collection;

class ShoppingCartItemRepository extends BaseRepository
{
    public function __construct(ShoppingCartItem $shoppingCartItem)
    {
        parent::__construct($shoppingCartItem);
    }

    public function findByProductIdAndShoppingCartId($product_id, $shopping_cart_id)
    {
        return $this->model->where('shopping_cart_id', $shopping_cart_id)->where('product_id', $product_id)->get();
    }

    
    public function getItems($session_id)
    {
        $items = $this->model->where('session_id', $session_id)
        ->join('products', 'products.id', '=', 'shopping_cart_items.product_id')
        ->get();

        return $items;
    }

    public function removeItem($session_id, $product_id)
    {
        $this->model->where('session_id', $session_id)->where('product_id', $product_id)->delete();
    }

    // public function getItemsByShoppingCart($shopping_cart_id)
    // {
    //     $items = $this->model->where('shopping_cart_id', $shopping_cart_id)
    //     ->join('products', 'products.id', '=', 'shopping_cart_items.product_id')
    //     ->get();
    //     return $items;
    // }
}

