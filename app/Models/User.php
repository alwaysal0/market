<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $guarded = false;

    public function admin() {
        return $this->hasOne(Admin::class, 'user_id', 'id');
    }

    public function isAdmin() {
        return $this->admin()->exists();
    }
}
