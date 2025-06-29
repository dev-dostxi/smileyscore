<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['section_id', 'rating', 'nickname', 'ip'];
    public function section()
    {
        return $this->belongsTo(Section::class)->withTrashed();
    }
}
