<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SectionUser extends Pivot
{
    protected $table = 'section_user';

    protected $fillable = ['user_id', 'section_id'];
}
