<?php 

namespace App\Services\Filters;

class PriceFilter
{
    private $min_price;
    private $max_price;
    private $slug;

    public function __construct($filters)
    {
        $this->min_price = $filters['min_price'] ?? 0; 
        $this->max_price = $filters['max_price'] ?? 10000;
        $this->slug = 'price';
    }

    public function getAttributeSlug()
    {
        return $this->slug;
    }

    public function getMinPrice()
    {
        return $this->min_price;
    }

    public function getMaxPrice()
    {
        return $this->max_price;
    }
}
