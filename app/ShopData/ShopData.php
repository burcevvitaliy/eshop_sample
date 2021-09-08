<?php

namespace App\ShopData;

class ShopData 
{
    private $shop_data;

    public function __construct()
    {
        $this->shop_data =  [
            'Laptops and Computers' => [
                'Laptops' => [
                   
                ],
                'Computers' => [

                ],
            ], 
            'Electronics' => [
                'Phones' => [
                    'Brands' => [
                        'SAMSUNG',
                        'Motorola',
                        'OnePlus',
                        'Google',
                    ],
                    'Display Size' => [
                        'up to 3.9 in',
                        '4 to 4.4 in',
                        '4.5 to 4.9 in',
                        '5 to 5.4 in',
                        '5.5 in & above',
                    ],
                    'Storage Memory' => [
                        'Up to 3.9 GB',
                        '4 GB',
                        '8 GB',
                        '16 GB',
                        '32 GB',
                        '64 GB',
                        '128 GB',
                        '256 GB & above',
                    ]
                ],
            ], 
            'TV' => [],
        ];        
    }

    public function getCategories()
    {
        return array_keys($this->shop_data);
    }

    public function getSubCategories($category_name)
    {
        return array_keys($this->shop_data[$category_name]);
    }

    public function getAttributes($category_name, $subcategory_name) 
    {
        return array_keys($this->shop_data[$category_name][$subcategory_name]);
    }

    public function getAttributeValues($category_name, $subcategory_name, $attribute_name) 
    {
        return $this->shop_data[$category_name][$subcategory_name][$attribute_name];
    }

    public function getShopData()
    {
        return $this->shop_data;
    }
}
