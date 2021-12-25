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
        'reductionperbori',
        'reductionpertora',
        'commissionperbori',
        'commissionpertora',
        //additional costs
        'selectorcost',
        'sortingcost',
        'bagpriceperbori',
        'bagpricepertora',
        'packingcostperbori',
        'packingcostpertora',
        'loadingcostperbori',
        'loadingcostpertora',
        'randomcost',
        'randomnote',
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
    public function stores()
    {
        $store_ids = $this->storages->unique()->pluck('store_id')->toArray();
        return Store::whereIn('id', $store_ids)->get();
    }
    public function actual()
    {
        $gross = $this->grossweight;
        $actual = $this->grossweight - $this->numofbori * $this->reductionperbori - $this->numoftora * $this->reductionpertora;
        return $actual;
    }

    public function basicprice()
    {
        return $this->actual() * $this->priceperkg;
    }
    public function addlcost()
    {
        $addlcost = $this->selectorcost + $this->sortingcost + $this->numofbori * ($this->bagpriceperbori + $this->packingcostperbori + $this->loadingcostperbori + $this->commissionperbori) + $this->numoftora * ($this->bagpricepertora + $this->packingcostpertora + $this->loadingcostpertora + $this->commissionpertora) + $this->randomcost;
        return $addlcost;
    }

    public function finalcostperkg()
    {
        $totalcost = $this->basicprice() + $this->addlcost();
        return $totalcost / $this->actual();
    }
    public function numofbori_stored()
    {
        return $this->storages()->sum('numofbori');
    }
    public function numoftora_stored()
    {
        return $this->storages()->sum('numoftora');
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