<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function productAttributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
