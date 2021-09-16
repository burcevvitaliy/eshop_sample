<?php 

namespace App\Repository;

/**
* Interface CategoryRepositoryInterface
* @package App\Repositories
*/
interface AttributeRepositoryInterface
{
    public function getAvailableAttributes($subcategory_id);
}
