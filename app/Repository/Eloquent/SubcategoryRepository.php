<?php

namespace App\Repository\Eloquent;

use App\Models\Subcategory;
use Illuminate\Support\Collection;

class SubcategoryRepository extends BaseRepository
{
    public function __construct(Subcategory $subcategory)
    {
        parent::__construct($subcategory);
    }

    public function showSubcategories($id):Collection
    {
        return $this->model->where('category_id', $id)->get();
    }
}

