<?php 

namespace App\Services;

use App\Repository\AttributeValueRepositoryInterface;

class FilterService 
{
    private $attributeValueRepository;

    public function __construct(AttributeValueRepositoryInterface $attributeValueRepository)
    {
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function getFilters($sub_category_id)
    {
        $filters = $this->attributeValueRepository->infoAboutFilters($sub_category_id);
         
        $grouped_filters = [];
        foreach ($filters as $filter) {
            if (!isset($grouped_filters[$filter->attribute_name])) {
                $grouped_filters[$filter->attribute_name] = [];
            }
            $grouped_filters[$filter->attribute_name][] = $filter;
        }
        return $grouped_filters;
    }
}
