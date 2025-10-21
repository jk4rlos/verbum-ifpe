<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title',
        'pix',
        'bank',
        'qrcode',
        'description'
    ];
}
