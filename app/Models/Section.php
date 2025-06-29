<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $fillable = ['slug', 'name'];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
        
}