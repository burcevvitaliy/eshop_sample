<?php

namespace App\Repository\Eloquent;

use App\Models\Shop\Subcategory;
use App\Repository\SubcategoryRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Config;

class SubcategoryRepository extends BaseRepository implements SubcategoryRepositoryInterface
{
    protected $cache;

    public function __construct(Subcategory $subcategory, Factory $cache)
    {
        parent::__construct($subcategory);
        $this->cache = $cache;
    }

    public function showSubcategories($id):Collection
    {
        $result = $this->cache->remember('subcategories', Config::get('CACHE_SUBCATEGORIES'), function () use ($id) {
            return $this->model->where('category_id', $id)->get();
        });

        return $result;
    }
}

