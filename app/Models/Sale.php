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
        'cost_id',
        'store_id',

        'numofbori',
        'numoftora',
        'grossweight',
        'reduction0',
        'reduction1',
        'saleprice',

        'dateon',

    ];
    public $timestamps = false;

    public function buyer()
    {
        return $this->belongsTo(buyer::class, 'buyer_id');
    }
}