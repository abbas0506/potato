<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'buyer_id',
        'sale_numofbori',
        'sale_numoftora',
        'sale_grossweight',
        'sale_actualweight',
        'sale_price',
        'sale_commission',
    ];
}