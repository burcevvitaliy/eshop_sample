<?php 

namespace App\Repository;

/**
* Interface ProductAttributeValueRepositoryInterface
* @package App\Repositories
*/
interface ProductAttributeValueRepositoryInterface
{
    public function productWithinFilters($filters);
    public function getDetailProduct($subcategory_id);
}
