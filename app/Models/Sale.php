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
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    public function actual()
    {
        $gross = $this->grossweight;
        $actual = $this->grossweight - $this->numofbori * $this->reduction0 - $this->numoftora * $this->reduction1;
        return $actual;
    }
    public function basicprice()
    {
        return $this->actual() * $this->purchase->priceperkg;
    }
    public function addlcost()
    {
        $cost = Cost::find($this->cost_id);
        $costperbori = $cost->commision0 + $cost->bagprice0 + $cost->packing0 + $cost->loading0 + $cost->carriage0 + $cost->storage0;
        $costpertora = $cost->commision1 + $cost->bagprice1 + $cost->packing1 + $cost->loading1 + $cost->carriage1 + $cost->storage1;
        $addl = $cost->selector + $cost->sorting + $cost->sadqa + $cost->random;
        return $this->numofbori * $costperbori + $this->numoftora * $costpertora + $addl;
    }
    public function profit()
    {
        return $this->saleprice - $this->basicprice() - $this->addlcost();
    }
}