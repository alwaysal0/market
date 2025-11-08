<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $guarded = false;

    public function products() {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    public function logs() {
        return $this->hasMany(Log::class, 'causer_id', 'id')->latest();
    }

    public function admin() {
        return $this->hasOne(Admin::class, 'user_id', 'id');
    }

    public function isAdmin() {
        return $this->admin()->exists();
    }
}
