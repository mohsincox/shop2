<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'price', 'stock', 'image', 'featured'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDiscountedPriceAttribute()
    {
        return round($this->price * 0.9, 2);
    }

    public function isInStock()
    {
        return $this->stock > 0;
    }
}
