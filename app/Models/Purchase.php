<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller_id',
        'product_id',
        'purchase_numofbori',
        'purchase_numoftora',
        'purchase_grossweight',
        'purchase_actualweight',
        'prchase_price',
        'purchase_commission',
        'purchase_bagscost',
        'purchase_selectorcost',
        'purchase_packingcost',
        'purchase_loadingcost',

    ];
}