<?php

namespace App\Repository\Eloquent;

use App\Models\AttributeValue;
use App\Repository\AttributeValueRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AttributeValueRepository extends BaseRepository implements AttributeValueRepositoryInterface
{
    public function __construct(AttributeValue $attributeValue)
    {
        parent::__construct($attributeValue);
    }

        
    public function infoAboutFilters($subcategory_id)
    {
        $result = $this->model->selectRaw(
        '
            attributes.id as attribute_id,
            attributes.name as attribute_name,
            attributes.slug as attribute_slug, 
            attribute_values.id as attribute_value_id,
            attribute_values.value as attribute_value,
            0 AS cnt
        '    
        )->join(
            'attributes', 'attributes.id', '=', 'attribute_values.attribute_id'
        )->where('subcategory_id', $subcategory_id)->get();

        return $result;
    }
}

