<?php

namespace App\Repository\Eloquent;

use App\Models\ProductAttributeValue;
use Illuminate\Support\Facades\DB;

class ProductAttributeValueRepository extends BaseRepository
{
    public function __construct(ProductAttributeValue $productAttributeValue)
    {
        parent::__construct($productAttributeValue);
    }

    public function productWithinFilters($filters)
    {

        $price_filters = reset($filters['price']);
        unset($filters['price']);
        $query = $this->model->select('products.id as product_id', 'products.name as product_name', 'products.photo', 'products.price');
        foreach ($filters as $grouped_filter) {
            $query = $query->whereExists(function($subquery) use($grouped_filter) {
                $filter = reset($grouped_filter);
                $ids = [];
         
                foreach ($grouped_filter as $filter) {
                    $ids[] = $filter->getAttributeValue();
                }
               
                
                $subquery->select(DB::raw(1))
                         ->from('product_attribute_values as p')
                         ->whereColumn('product_attribute_values.product_id', 'p.product_id')
                         ->where([ 
                            ['attribute_id', $filter->getAttributeId()],
                        ])
                        ->whereIn('attribute_value_id', $ids);
            });
        }
        $query = $query->join('products', 'products.id', '=', 'product_attribute_values.product_id')->groupBy('product_attribute_values.product_id');
  
        $query->where('price', '>=', $price_filters->getMinPrice());
        $query->where('price', '<=', $price_filters->getMaxPrice());
        $result = $query->get();

        return $result;
    }
}
