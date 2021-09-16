<?php

namespace App\Http\Controllers;

use App\Repository\ProductAttributeValueRepositoryInterface;

class ProductController extends Controller
{
    public function show($product_id, ProductAttributeValueRepositoryInterface $productAttributeValueRepository)
    {
        $product = $productAttributeValueRepository->getDetailProduct($product_id);
        

        return view('shop.product', [
            'product' => $product
        ]);
    }
}
