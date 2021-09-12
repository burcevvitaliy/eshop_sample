<?php

namespace App\Repository\Eloquent;

use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function createOrder($session_id, $shopping_cart_items, $order_data)
    {        
        DB::transaction(function () use ($session_id, $shopping_cart_items, $order_data) {
            $saved_order_id = 0;
            $full_price_sum = 0;
            $order_items = [];

            foreach ($shopping_cart_items as $item) {
                $full_price_sum += $full_price = $item['price'] * $item['count'];

                $order_items[] = [
                    'order_id'  => &$saved_order_id,
                    'product_id' => $item['product_id'],
                    'count' => $item['count'],
                    'item_price' => $item['price'],
                    'full_price' => $full_price,
                ];
            }
            
            $order_data['full_price'] = $full_price_sum;

            $order = $this->model->create($order_data);
            $saved_order_id = $order->id;
            DB::table('order_items')->insert($order_items);
            DB::table('shopping_cart_items')->where('session_id', $session_id)->delete();
        });
    }
}
