<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['section_id', 'rating', 'nickname', 'comment', 'ip'];
    
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class)->withTrashed();
    }
    public function scopeWithinDates($query, $start, $end)
    {
        return $query->when($start, fn ($q) => $q->whereDate('created_at', '>=', $start))
                    ->when($end, fn ($q) => $q->whereDate('created_at', '<=', $end));
    }
}
