<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'client_id',
        'numofbori',
        'numoftora',
        'grossweight',
        'transporter_id',
        'vehicleno',
        'carriage',
        'commission',
        'saleprice',
        //additional costs in case of sale from store
        'store_id',
        'bagscost',
        'selectorcost',
        'sortingcost',
        'packingcost',
        'loadingcost',
        'randomcost',
        'dateon',

    ];
    public $timestamps = false;
}