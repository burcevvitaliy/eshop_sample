<?php

namespace App\Repository\Eloquent;

use App\Models\OrderItem;
use Illuminate\Support\Collection;

class OrderItemRepository extends BaseRepository
{
    public function __construct(OrderItem $order_item)
    {
        parent::__construct($order_item);
    }
}
