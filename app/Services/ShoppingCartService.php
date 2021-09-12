<?php 

namespace App\Services;

use App\Repository\Eloquent\ShoppingCartItemRepository;
use App\Repository\Eloquent\ShoppingCartRepository;

class ShoppingCartService
{
    private $shoppingCartRepository;
    private $shoppingCartItemRepository;

    public function __construct(ShoppingCartRepository $shoppingCartRepository, ShoppingCartItemRepository $shoppingCartItemRepository)
    {
        $this->shoppingCartRepository = $shoppingCartRepository;
        $this->shoppingCartItemRepository = $shoppingCartItemRepository;
    }

    public function showShoppingCart($session_id)
    {
        return $this->shoppingCartItemRepository->getItems($session_id);
    }

    public function removeItem($session_id, $product_id)
    {
        $this->shoppingCartItemRepository->removeItem($session_id, $product_id);
    }

    public function addItem($session_id, $product_id)
    {
        $shopping_cart = $this->shoppingCartRepository->getShoppingCartBySessionId($session_id);
      
        if ($shopping_cart->isEmpty()) {
            $shopping_cart = $this->shoppingCartRepository->create(['session_id' => $session_id]);
            
        } 

        $shopping_cart_item = $this->shoppingCartItemRepository->findByProductIdAndShoppingCartId($product_id, $shopping_cart->first()->id);
        if ($shopping_cart_item->isEmpty()) {
            $this->shoppingCartItemRepository->create(['session_id' => $session_id, 'product_id' => $product_id, 'shopping_cart_id' => $shopping_cart->first()->id, 'count' => 1]);
        } else { 
            //throw exception
        }
        
    }

    public function changeItemCount($session_id, $product_id, $count)
    {
        if ($count <= 0) {
            $count = 1;
        }

        $shopping_cart = $this->shoppingCartRepository->getShoppingCartBySessionId($session_id);

        if ($shopping_cart->isEmpty()) {
            //throw exception
        }

        $shopping_cart_item = $this->shoppingCartItemRepository->findByProductIdAndShoppingCartId($product_id, $shopping_cart->first()->id);
        if ($shopping_cart_item->isEmpty()) {
            //throw exception
        }

        $this->shoppingCartItemRepository->update(['id' => $shopping_cart_item->first()->id, 'count' => $count]);
    }

    public function markProductsInCart($products, $shopping_cart_items)
    {
        $product_ids = $shopping_cart_items->pluck('product_id')->toArray();
      
        foreach ($products as $product) {
            if (in_array($product->product_id, $product_ids)) {
                $product->is_in_cart = 1;          
            }
        }

       
        return $products;
    }
}
