<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    protected $table = "responses";
    protected $fillable = [
        'user_id', 'report_id', 'content'
    ];

    public function report() : BelongsTo
    {
        return $this->belongsTo(Report::class, 'report_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
