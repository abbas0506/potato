<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'deal_id',
        'numofbori',
        'numoftora',
        'transporter_id',
        'vehicleno',
        'grossweight',
        'priceperkg',
        'cost_id',
        'dateon',
    ];
    protected $dates = ['dateon'];
    public $timestamps = false;

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }
    public function transporter()
    {
        return $this->belongsTo(Transporter::class, 'transporter_id');
    }

    public function stores()
    {
        $store_ids = $this->storages->unique()->pluck('store_id')->toArray();
        return Store::whereIn('id', $store_ids)->get();
    }
    public function actual()
    {
        $gross = $this->grossweight;
        $actual = $this->grossweight - $this->numofbori * $this->deal->reduction0 - $this->numoftora * $this->deal->reduction1;
        return $actual;
    }

    public function basicprice()
    {
        return $this->actual() * $this->priceperkg;
    }

    public function addlcost()
    {
        return $this->selector + $this->sorting + $this->numofbori * ($this->bagprice0 + $this->commission0 + $this->packing0 + $this->loading0 + $this->commission0) + $this->numoftora * ($this->bagprice1 + $this->commission1 + $this->packing1 + $this->loading1 + $this->commission1) + $this->random + $this->sadqa;
    }

    public function finalcostperkg()
    {
        $totalcost = $this->basicprice() + $this->addlcost();
        return $totalcost / $this->actual();
    }

    // QTY
    public function qty()
    {
        return $this->numofbori . "-" . $this->numoftora;
    }

    // STORAGE

    public function storages()
    {
        return $this->hasMany(Storage::class, 'purchase_id');
    }

    public function numofbori_stored()
    {
        return $this->storages()->sum('numofbori');
    }

    public function numoftora_stored()
    {
        return $this->storages()->sum('numoftora');
    }

    public function stored()
    {
        return $this->numofbori_stored() . "+" . $this->numoftora_stored();
    }

    // RETENSION
    public function numofbori_retained()
    {
        return $this->numofbori_stored() - $this->numofbori_exported() - $this->numofbori_wasted();
    }
    public function numoftora_retained()
    {
        return $this->numoftora_stored() - $this->numoftora_exported() - $this->numoftora_wasted();
    }
    public function retained()
    {
        $numofbori_retained = $this->numofbori_stored() - $this->numofbori_exported() - $this->numofbori_wasted();
        $numoftora_retained = $this->numoftora_stored() - $this->numoftora_exported() - $this->numoftora_wasted();
        return $numofbori_retained . "+" . $numoftora_retained;
    }

    // EXPORT
    public function exports()
    {
        return $this->hasMany(Sale::class, 'purchase_id')->whereNotNull('store_id');
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
        return $this->numofbori_exported() . "-" . $this->numoftora_exported();
    }

    // WASTE

    public function wastes()
    {
        return $this->hasMany(Waste::class, 'purchase_id');
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
        return $this->numofbori_wasted() . "+" . $this->numoftora_wasted();
    }


    //SALE

    public function sales()
    {
        return $this->hasMany(Sale::class, 'purchase_id');
    }
    public function numofbori_sold()
    {
        return $this->sales()->sum('numofbori');
    }
    public function numoftora_sold()
    {
        return $this->sales()->sum('numoftora');
    }
    public function sold()
    {
        return $this->numofbori_sold() . "+" . $this->numoftora_sold();
    }


    // LEFT or REMAINING

    public function numofbori_left()
    {
        return $this->numofbori - $this->numofbori_sold() - $this->numofbori_retained() - $this->numofbori_wasted();
    }
    public function numoftora_left()
    {
        return $this->numoftora - $this->numoftora_sold() - $this->numoftora_retained() - $this->numoftora_wasted();
    }
    public function left()
    {
        return $this->numofbori_left() . "+" . $this->numoftora_left();
    }
}