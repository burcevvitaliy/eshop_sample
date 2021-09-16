<?php 

namespace App\Repository;

/**
* Interface ShoppingCartRepositoryInterface
* @package App\Repositories
*/
interface ShoppingCartRepositoryInterface
{
    public function getShoppingCartBySessionId($session_id);
}
