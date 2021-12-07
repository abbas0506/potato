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
        'numofbori',
        'numoftora',
        'grossweight',
        'unitprice',
        'commission',
        'bagscost',
        'selectorcost',
        'packingcost',
        'loadingcost',

    ];
}