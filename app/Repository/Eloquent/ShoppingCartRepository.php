<?php

namespace App\Repository\Eloquent;

use App\Models\ShoppingCart;
use Illuminate\Support\Collection;

class ShoppingCartRepository extends BaseRepository
{
    public function __construct(ShoppingCart $shoppingCart)
    {
        parent::__construct($shoppingCart);
    }

    public function getShoppingCartBySessionId($session_id)
    {
        return $this->model->where('session_id', $session_id)->get();
    }
}

