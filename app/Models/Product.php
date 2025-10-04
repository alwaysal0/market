<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = false;

    public function filters() {
        return $this->hasMany(Filter::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
