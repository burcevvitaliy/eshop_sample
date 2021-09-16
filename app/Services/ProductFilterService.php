<?php 

namespace App\Services;

use App\Repository\AttributeRepositoryInterface;
use App\Repository\Eloquent\AttributeRepository;
use App\Services\Filters\PriceFilter;
use App\Services\Filters\ProductFilter;

class ProductFilterService
{
    private $attributeRepository;
    private $filters = [];
    private $available_filters = [];

    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }
    
    public function setFilters($subcategory_id, array $filters) 
    {
        $attributes = $this->attributeRepository->getAvailableAttributes($subcategory_id);

        //subcategory filters
        foreach ($filters as $filter_attribute_id => $filter_attribute_value) {
            foreach($attributes as $attribute) {
                if ($filter_attribute_id == $attribute->slug) {
                    $filter_attribute_value_arr = explode(',', $filter_attribute_value);
                    foreach ($filter_attribute_value_arr as $separated_attribute_value) {
                        $this->add(new ProductFilter($attribute->id, $separated_attribute_value, $attribute->slug));
                    }

                    break;
                }
            }
        }

        //price filters
        $this->add(new PriceFilter($filters));   
    }

    public function add($filter)
    {
        if (!isset($this->filters[$filter->getAttributeSlug()]))
        {
            $this->filters[$filter->getAttributeSlug()] = [];
        }

        $this->filters[$filter->getAttributeSlug()][] = $filter;
    } 

    public function getFilters() 
    {
        return $this->filters;
    }
}
