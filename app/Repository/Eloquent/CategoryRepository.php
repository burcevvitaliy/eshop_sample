<?php

namespace App\Repository\Eloquent;

use App\Models\Shop\Category;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
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
