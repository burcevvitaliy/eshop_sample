<?php

namespace App\Repository\Eloquent;

use App\Models\Shop\Subcategory;
use App\Repository\SubcategoryRepositoryInterface;
use Illuminate\Support\Collection;

class SubcategoryRepository extends BaseRepository implements SubcategoryRepositoryInterface
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

