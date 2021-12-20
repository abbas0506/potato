<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $fillable = [
        'reductionperbori',
        'reductionpertora',
        'commissionperbori',
        'commissionpertora',
        'bagpriceperbori',
        'bagpricepertora',
        'packingcostperbori',
        'packingcostpertora',
        'loadingcostperbori',
        'loadingcostpertora',
    ];

    public $timestamps = false;
}
