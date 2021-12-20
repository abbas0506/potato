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
        'carriage',
        'commission',
        'saleprice',
        //additional costs in case of sale from store
        'store_id',
        'selectorcost',
        'sortingcost',
        'bagpriceperbori',
        'bagpricepertora',
        'packingcostperbori',
        'packingcostpertora',
        'loadingcostperbori',
        'loadingcostpertora',
        'randomcost',
        'dateon',

    ];
    public $timestamps = false;

    public function buyer()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
