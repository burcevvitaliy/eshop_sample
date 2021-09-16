<?php

namespace App\Repository\Eloquent;

use App\Models\Shop\Attribute;
use App\Repository\AttributeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    public function __construct(Attribute $attribute)
    {
        parent::__construct($attribute);
    }

    public function getAvailableAttributes($subcategory_id)
    {
        $attributes = $this->model->where('subcategory_id', $subcategory_id)->get();
        return $attributes;
    }
}
