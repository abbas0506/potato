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
        'store_id',       //if sale from store

        'numofbori',
        'numoftora',
        'grossweight',
        'reduction0',
        'reduction1',
        'saleprice',

        'dateon',

    ];
    protected $dates = ['dateon'];
    public $timestamps = false;

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    public function buyer()
    {
        return $this->belongsTo(buyer::class, 'buyer_id');
    }

    public function store()
    {
        return $this->belongsTo(Storage::class, 'store_id');
    }

    public function cost()
    {
        return $this->belongsTo(Cost::class, 'cost_id');
    }

    public function qty()
    {
        return  $this->numofbori . "-" . $this->numoftora;
    }
    public function actual()
    {
        return  $this->grossweight - $this->numofbori * $this->reduction0 - $this->numoftora * $this->reduction1;
    }

    //COST

    public function basicprice()
    {
        return $this->actual() * $this->purchase->priceperkg;
    }
    public function currentcost()
    {
        $cost = Cost::find($this->cost_id);
        $costperbori = $cost->commission0 + $cost->bagprice0 + $cost->packing0 + $cost->loading0 + $cost->carriage0 + $cost->storage0;
        $costpertora = $cost->commission1 + $cost->bagprice1 + $cost->packing1 + $cost->loading1 + $cost->carriage1 + $cost->storage1;
        $addl = $cost->selector + $cost->sorting + $cost->sadqa + $cost->random;
        return $this->numofbori * $costperbori + $this->numoftora * $costpertora + $addl;
    }

    public function precost()
    {
        //if sale from store, then
        if ($this->store_id)
            return $this->actual() * $this->store->approxcostperkg();
        else
            return $this->basicprice();
        //return $this->numofbori * $costperbori + $this->numoftora * $costpertora + $addl;
    }
    // public function addlcost()
    // {
    //     return round($this->currentcost() + $this->precost());
    // }

    public function costprice()
    {
        return $this->precost() + $this->currentcost();
    }
    public function profit()
    {
        return $this->saleprice - $this->costprice();
    }
}