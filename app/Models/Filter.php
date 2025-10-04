<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $table = 'filters';
    protected $guarded = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
