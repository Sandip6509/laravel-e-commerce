<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'price',
        'sale_price',
        'color',
        'brand_id',
        'product_code',
        'gender',
        'function',
        'stock',
        'description',
        'image',
        'is_active',
    ];

    public function getBrandData()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function getProductNameAttribute()
    {
        return  Str::of($this->name)->replace('_', ' ')->title()->value();
    }
}
