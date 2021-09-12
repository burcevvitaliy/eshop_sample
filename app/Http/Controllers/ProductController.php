<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\ProductAttributeValueRepository;

class ProductController extends Controller
{
    public function show($product_id, ProductAttributeValueRepository $productAttributeValueRepository)
    {
        $product = $productAttributeValueRepository->getDetailProduct($product_id);
        

        return view('shop.product', [
            'product' => $product
        ]);
    }
}
