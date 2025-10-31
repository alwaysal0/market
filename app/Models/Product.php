<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = false;

    public function filters()
    {
        return $this->hasMany(Filter::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $ttl = now()->addHour();
        $cacheKey = "product:" . $value;
        $field = $field ?? $this->getRouteKeyName();
        $attributes =  Cache::tags(["products"])->remember($cacheKey, $ttl, function () use ($value, $field) {
            $product = Product::where($field, $value)->first();
            if (!$product) {
                throw new ModelNotFoundException();
            }
            return $product->getAttributes();
//            return Product::where($field, $value)->first()->getAttributes();
        });

        return $this->newInstance($attributes, true);
    }
}
