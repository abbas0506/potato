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
        'unitprice',
        'commissionperbori',
        'commissionpertora',
        //additional costs
        'selectorcost',
        'sortingcost',
        'materialcostperbori',
        'materialcostpertora',
        'packingcostperbori',
        'packingcostpertora',
        'loadingcostperbori',
        'loadingcostpertora',
        'randomcost',
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