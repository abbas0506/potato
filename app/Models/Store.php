<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function storages($id)
    {
        return $this->hasMany(Storage::class, 'store_id')->where('purchase_id', $id);
    }
    public function wastes($id)
    {
        return $this->hasMany(Waste::class, 'store_id')->where('purchase_id', $id);
    }
    public function sales($id)
    {
        return $this->hasMany(Sale::class, 'store_id')->whereNotNull('store_id')->where('purchase_id', $id);
    }

    //store related 
    public function numofbori_stored($id)
    {
        return $this->storages($id)->sum('numofbori');
    }
    public function numoftora_stored($id)
    {
        return $this->storages($id)->sum('numoftora');
    }
    public function stored($id)
    {
        return $this->numofbori_stored($id) . "-" . $this->numoftora_stored($id);
    }

    //EXPORT or SALE
    public function numofbori_exported($id)
    {
        return $this->sales($id)->sum('numofbori');
    }
    public function numoftora_exported($id)
    {
        return $this->sales($id)->sum('numoftora');
    }
    public function exported($id)
    {
        return $this->numofbori_exported($id) . "-" . $this->numoftora_exported($id);
    }

    //WASTE
    public function numofbori_wasted($id)
    {
        return $this->wastes($id)->sum('numofbori');
    }
    public function numoftora_wasted($id)
    {
        return $this->wastes($id)->sum('numoftora');
    }
    public function wasted($id)
    {
        return $this->numofbori_wasted($id) . "-" . $this->numoftora_wasted($id);
    }


    //RETENSION
    public function numofbori_retained($id)
    {
        return $this->numofbori_stored($id) - $this->numofbori_exported($id) - $this->numofbori_wasted($id);
    }
    public function numoftora_retained($id)
    {
        return $this->numoftora_stored($id) - $this->numoftora_exported($id) - $this->numoftora_wasted($id);
    }

    public function retained($id)
    {
        return $this->numofbori_retained($id) . "-" . $this->numoftora_retained($id);
    }

    public function approxcostperkg($id)
    {
        //calculate total storage weight using normal wwights like 158 kg / bori, 57kg/tora
        $approx_weight = $this->storages($id)->get()->sum(function ($storage) {
            return $storage->approxweight();
        });

        $approx_cost = $this->storages($id)->get()->sum(function ($storage) {
            return $storage->approxcost();
        });
        if ($approx_weight == 0) return -1;
        else return $approx_cost / $approx_weight;
    }

    public function approxvalue_retained($id)
    {
        $approxweight_retained = 118 * $this->numofbori_retained($id) + 57 * $this->numoftora_retained($id);
        return $approxweight_retained * $this->approxcostperkg($id);
    }

    public $timestamps = false;
}