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

    public function numofbori_stored($id)
    {
        return $this->hasMany(Storage::class, 'store_id')->where('purchase_id', $id)->sum('numofbori');
    }
    public function numofbori_wasted($id)
    {
        return $this->hasMany(Waste::class, 'store_id')->where('purchase_id', $id)->sum('numofbori');
    }
    public function numoftora_stored($id)
    {
        return $this->hasMany(Storage::class, 'store_id')->where('purchase_id', $id)->sum('numoftora');
    }
    public function numoftora_wasted($id)
    {
        return $this->hasMany(Waste::class, 'store_id')->where('purchase_id', $id)->sum('numoftora');
    }

    public function numofbori_left($id)
    {
        return $this->numofbori_stored($id) - $this->numofbori_wasted($id);
    }
    public function numoftora_left($id)
    {
        return $this->numoftora_stored($id) - $this->numoftora_wasted($id);
    }
    public function approxweight($id)
    {
        $purchase = Purchase::find($id);
        return 0;
    }

    public $timestamps = false;
}