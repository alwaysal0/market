<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $fillable = [
        'user_id', 'content', 'reportable_id', 'reportable_type', 'response', 'status',
    ];
    protected $casts = [
        'status' => 'integer',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeClosed(Builder $query) : Builder
    {
        return $query->where('status', '0');
    }
    public function scopeOpened(Builder $query): Builder
    {
        return $query->where('status', '1');
    }
}
