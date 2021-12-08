<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
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

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}