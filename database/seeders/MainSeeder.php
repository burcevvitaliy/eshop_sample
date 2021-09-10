<?php

namespace Database\Seeders;

use App\Models\Product;
use App\ShopData\ShopData;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ShopData $appSeeder, Generator $faker)
    {
        $categories = $appSeeder->getCategories();
 
        foreach ($categories as $category_name) {
            $category_id = DB::table('categories')->insertGetId([
                'name' => $category_name,
                'photo' => $faker->imageUrl(),
            ]);
            
            $sub_categories = $appSeeder->getSubCategories($category_name);

            foreach ($sub_categories as $sub_category_name) {
                $subcategory_id = DB::table('subcategories')->insertGetId([
                    'name' => $sub_category_name,
                    'photo' => $faker->imageUrl(),
                    'category_id' => $category_id
                ]);

                $attributes = $appSeeder->getAttributes($category_name, $sub_category_name);

                if (empty($attributes)) {
                    continue;
                }
                //product
                $products = Product::factory(5)->create();

                foreach ($attributes as $attribute_name) {
                    $attribute_id = DB::table('attributes')->insertGetId([
                        'name' => $attribute_name,
                        'slug' =>  Str::slug($attribute_name, '_'),
                        'subcategory_id' => $subcategory_id
                    ]);

                    $attribute_values = $appSeeder->getAttributeValues($category_name, $sub_category_name, $attribute_name);
                    
                    $attribute_value_ids = [];
                    foreach ($attribute_values as $attribute_value) {
                        $attribute_value_ids[] = $attribute_value_id = DB::table('attribute_values')->insertGetId([
                            'value' => $attribute_value,
                            'attribute_id' => $attribute_id
                        ]);
                    }

                    if (empty($attribute_values)) {
                        continue;
                    }
                    
                    foreach ($products as $product) {
                        //Product attribute values
                        DB::table('product_attribute_values')->insert([
                            'product_id' => $product->id,
                            'attribute_id' => $attribute_id,
                            'attribute_value_id' => $attribute_value_ids[rand(0, count($attribute_value_ids) - 1)],
                        ]);
                    } 
                }
            }
            
        }
    }
}
