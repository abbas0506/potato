<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'reduction0',
        'reduction1',
        'cost_id',
        'dateon',
    ];

    public $timestamps = false;

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    public function storages()
    {
        return $this->hasMany(Storage::class, 'purchase_id');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'purchase_id');
    }

    public function sales_field()
    {
        return $this->hasMany(Sale::class, 'purchase_id')->whereNull('store_id');
    }

    public function sales_storage()
    {
        return $this->hasMany(Sale::class, 'purchase_id')->whereNotNull('store_id');
    }

    public function stores()
    {
        $store_ids = $this->storages->unique()->pluck('store_id')->toArray();
        return Store::whereIn('id', $store_ids)->get();
    }
    public function actual()
    {
        $gross = $this->grossweight;
        $actual = $this->grossweight - $this->numofbori * $this->reduction0 - $this->numoftora * $this->reduction1;
        return $actual;
    }

    public function basicprice()
    {
        return $this->actual() * $this->priceperkg;
    }
    public function addlcost()
    {
        $addlcost = $this->selector + $this->sorting + $this->numofbori * ($this->bagprice0 + $this->packing0 + $this->loading0 + $this->commission0) + $this->numoftora * ($this->bagprice1 + $this->packing1 + $this->loading1 + $this->commission1) + $this->random + $this->sadqa;
        return $addlcost;
    }

    public function finalcostperkg()
    {
        $totalcost = $this->basicprice() + $this->addlcost();
        return $totalcost / $this->actual();
    }
    public function numofbori_stored()
    {
        $numofbori_stored = $this->storages()->sum('numofbori');
        $numofbori_soldfromstorage = $this->sales_storage()->sum('numofbori');
        return $numofbori_stored - $numofbori_soldfromstorage;
    }

    public function numoftora_stored()
    {
        $numoftora_stored = $this->storages()->sum('numoftora');
        $numoftora_soldfromstorage = $this->sales_storage()->sum('numoftora');
        return $numoftora_stored - $numoftora_soldfromstorage;
    }

    public function numofbori_sold()
    {
        return $this->sales()->sum('numofbori');
    }
    public function numoftora_sold()
    {
        return $this->sales()->sum('numoftora');
    }
    public function numofbori_left()
    {
        return $this->numofbori - $this->numofbori_sold() - $this->numofbori_stored();
    }
    public function numoftora_left()
    {
        return $this->numoftora - $this->numoftora_sold() - $this->numoftora_stored();
    }
}
