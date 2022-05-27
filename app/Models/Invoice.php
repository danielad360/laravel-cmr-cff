<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Invoice extends Authenticatable
{
    protected $table = 'invoice';

    protected $fillable = [
        'parts',
        'products',
        'from',
        'to',
        'invoice_number',
        'amount',
        'note',
    ];
}
