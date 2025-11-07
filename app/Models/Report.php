<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $fillable = [
        'user_id', 'content', 'reportable_id', 'reportable_type', 'response', 'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
