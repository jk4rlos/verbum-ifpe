<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mass extends Model
{
    protected $fillable = [
        'dayweek',
        'time',
        'description',
    ];
}
