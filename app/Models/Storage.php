<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Storage extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'store_id',
        'numofbori',
        'numoftora',
        'cost_id',
        'dateon',
    ];
    protected $dates = ['dateon'];
    public $timestamps = false;

    // QTY
    public function qty()
    {
        return $this->numofbori . "-" . $this->numoftora;
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    //EXPORT
    public function exports()
    {
        return Sale::where('purchase_id', $this->purchase_id)->where('store_id', $this->store_id);
    }
    public function numofbori_exported()
    {
        return $this->exports()->sum('numofbori');
    }
    public function numoftora_exported()
    {
        return $this->exports()->sum('numoftora');
    }

    public function exported()
    {
        return $this->numoftora_exported() . "-" . $this->numoftora_exported();
    }

    //WASTE
    public function wastes()
    {
        return Waste::where('purchase_id', $this->purchase_id)->where('store_id', $this->store_id);
    }

    public function numofbori_wasted()
    {
        return $this->wastes()->sum('numofbori');
    }
    public function numoftora_wasted()
    {
        return $this->wastes()->sum('numoftora');
    }
    public function wasted()
    {
        return $this->numofbori_wasted() . "-" . $this->numoftora_wasted();
    }

    //RETENSION
    public function numofbori_retained()
    {
        return $this->numofbori - $this->numofbori_exported() - $this->numofbori_wasted();
    }
    public function numoftora_retained()
    {
        return $this->numoftora - $this->numoftora_exported() - $this->numoftora_wasted();
    }

    public function retained()
    {
        return $this->numofbori_retained() . "-" . $this->numoftora_retained();
    }

    public function cost()
    {
        return $this->belongsTo(Cost::class, 'cost_id');
    }

    public function approxweight()
    {
        return 118 * $this->numofbori  + 57 * $this->numoftora;
    }
    public function approxcost()
    {
        $cost = $this->cost;
        $sellerprice = $this->approxweight() * $this->purchase->priceperkg;
        $storagecost0 = $this->numofbori * ($cost->commission0 + $cost->bagprice0 + $cost->packing0 + $cost->loading0 + $cost->carriage0 + $cost->storage0);
        $storagecost1 = $this->numoftora * ($cost->commission1 + $cost->bagprice1 + $cost->packing1 + $cost->loading1 + $cost->carriage1 + $cost->storage1);
        return $sellerprice + $storagecost0 + $storagecost1 + $cost->selector + $cost->sorting + $cost->sadqa + $cost->random;
    }

    public function approxcostperkg()
    {
        return $this->approxcost() / $this->approxweight();
    }
}