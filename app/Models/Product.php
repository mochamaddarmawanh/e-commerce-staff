<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'category_id',
        'brand_id',
        'first_image',
        'second_image',
        'third_image',
        'name',
        'slug',
        'gender',
        'description',
        'weight',
        'actual_price',
        'final_price',
        'dealer_price',
        'discount',
        'stock',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_color()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function product_tag()
    {
        return $this->hasMany(ProductTag::class);
    }

    public function product_size()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function size()
    {
        return $this->belongsToMany(size::class, 'product_sizes');
    }
}
