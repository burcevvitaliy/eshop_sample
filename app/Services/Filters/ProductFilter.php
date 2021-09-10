<?php 

namespace App\Services\Filters;

class ProductFilter
{
    private $attribute_id;
    private $attribute_value;
    private $attribute_slug;

    public function __construct($attribute_id, $attribute_value, $attribute_slug)
    {
        $this->attribute_id = $attribute_id;
        $this->attribute_value = $attribute_value;
        $this->attribute_slug = $attribute_slug;
    }

    public function getAttributeId()
    {
        return $this->attribute_id;
    }

    public function getAttributeValue()
    {
        return $this->attribute_value;
    }

    public function getAttributeSlug()
    {
        return $this->attribute_slug;
    }
}
