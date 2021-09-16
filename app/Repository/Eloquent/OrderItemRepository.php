<?php

namespace App\Repository\Eloquent;

use App\Models\OrderItem;
use App\Repository\OrderItemRepositoryInterface;
use Illuminate\Support\Collection;

class OrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface
{
    public function __construct(OrderItem $order_item)
    {
        parent::__construct($order_item);
    }
}
