<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Product extends Authenticatable
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
