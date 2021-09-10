<?php 

namespace App\Services;

use App\Repository\Eloquent\ProductAttributeValueRepository;
use App\Services\ProductFilters\ProductFilter;
use Illuminate\Cache\Repository;

class ProductListService
{
    private $productAttributeValueRepository;
    private $productFilterService;

    public function __construct(ProductAttributeValueRepository $productAttributeValueRepository, ProductFilterService $productFilterService)
    {
        $this->productAttributeValueRepository = $productAttributeValueRepository;
        $this->productFilterService = $productFilterService;
    }

    public function showProductsWithinSubCategory($subcategory_id, $filters)
    {
        $this->productFilterService->setFilters($subcategory_id, $filters);
        $products = $this->productAttributeValueRepository->productWithinFilters($this->productFilterService->getFilters());
        return $products;
    }
}
