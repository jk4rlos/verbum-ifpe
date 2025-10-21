<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyWarning extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'link',
        'startDate',
        'endDate',
    ];
}
