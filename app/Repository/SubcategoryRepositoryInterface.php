<?php 

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

/**
* Interface SubcategoryRepositoryInterface
* @package App\Repositories
*/
interface SubcategoryRepositoryInterface
{
    public function showSubcategories($id);
}
