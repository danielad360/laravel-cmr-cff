<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Parts extends Authenticatable
{
    protected $fillable = [
        'name',
        'stock',
        'price',
        'image',
    ];
}
