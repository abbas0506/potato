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

    public function exports()
    {
        return Sale::where('purchase_id', $this->purchase_id)->where('store_id', $this->store_id);
    }
    public function exported()
    {
        return $this->exports()->sum('numofbori') . "-" . $this->exports()->sum('numoftora');
    }
    public function wastes()
    {
        return Waste::where('purchase_id', $this->purchase_id)->where('store_id', $this->store_id);
    }
    public function wasted()
    {
        return $this->wastes()->sum('numofbori') . "-" . $this->wastes()->sum('numoftora');
    }
    public function numofbori_wasted()
    {
        return $this->wastes()->sum('numofbori');
    }
    public function numoftora_wasted()
    {
        return $this->wastes()->sum('numoftora');
    }

    public function left()
    {
        $numofbori_left = $this->numofbori -  $this->numofbori_wasted();
        $numoftora_left = $this->numoftora - $this->numoftora_wasted();
        return $numofbori_left . "-" . $numoftora_left;
    }

    public function cost()
    {
        return $this->belongsTo(Cost::class, 'cost_id');
    }
    public function storagecost()
    {
        $cost = $this->cost;
        $costperbori = $cost->commission0 + $cost->bagprice0 + $cost->packing0 + $cost->loading0 + $cost->carriage0 + $cost->storage0;
        $costpertora = $cost->commission1 + $cost->bagprice1 + $cost->packing1 + $cost->loading1 + $cost->carriage1 + $cost->storage1;
        $addl = $cost->selector + $cost->sorting + $cost->sadqa + $cost->random;
        return $this->numofbori * $costperbori + $this->numoftora * $costpertora + $addl;
    }
    public function storagecostperkg()
    {
        $weight = 100 * $this->numofbori + 50 * $this->numoftora;
        return $this->storagecost / $weight;
    }
}