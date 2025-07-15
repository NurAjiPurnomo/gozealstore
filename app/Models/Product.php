<?php

namespace App\Models;

use Binafy\LaravelCart\Cartable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Cartable
{
    protected $appends = ['image_url'];

    protected $fillable = [
        'name',
        'product_category_id',
        'sku',
        'price',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'product_category_id');
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImageUrlAttribute()
    {
        if (isset($this->attributes['image_url']) && $this->attributes['image_url']) {
            return $this->attributes['image_url'];
        }
        if (isset($this->attributes['image']) && $this->attributes['image']) {
            return asset('storage/'.$this->attributes['image']);
        }

        return null;
    }
}
