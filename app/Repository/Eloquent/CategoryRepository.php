<?php

namespace App\Repository\Eloquent;

use App\Models\Shop\Category;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Config;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected $cache;

    public function __construct(Category $category, Factory $cache)
    {
        parent::__construct($category);
        $this->cache = $cache;
    }

    public function showCategoriesForHomePage():Collection
    {
        $result = $this->cache->remember('categories', Config::get('CACHE_CATEGORIES'), function () {
            return $this->all();
        });

        return $result;
    }
}
