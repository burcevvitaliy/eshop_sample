<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function showCategoriesForHomePage():Collection
    {
        return $this->all();
    }
}
