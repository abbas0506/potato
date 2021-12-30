<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller_id',
        'product_id',
        'numofbori',
        'numoftora',
        'reduction0',
        'reduction1',
        'priceperkg',
        'dateon',
    ];

    public $timestamps = false;

    public function seller()
    {
        return $this->belongsTo(seller::class, 'seller_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'deal_id');
    }

    public function sales()
    {
        //return $this->hasMany(Sale::class, 'purchase_id');
    }

    public function numofbori_picked()
    {
        return $this->purchases()->sum('numofbori');
    }
    public function numoftora_picked()
    {
        return $this->purchases()->sum('numoftora');
    }
    public function numofbori_stored()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->storages->sum('numofbori') - $purchase->sales_storage->sum('numofbori');
        });
    }
    public function numoftora_stored()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->storages->sum('numoftora') - $purchase->sales_storage->sum('numoftora');
        });
    }
    public function numofbori_sold()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->sales->sum('numofbori');
        });
    }
    public function numoftora_sold()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->sales->sum('numoftora');
        });
    }

    public function numofbori_left()
    {
        return $this->numofbori - $this->purchases()->sum('numofbori');
    }
    public function numoftora_left()
    {
        return $this->numoftora - $this->purchases()->sum('numoftora');
    }


    public function stored()
    {
        //return $this->storages()->sum('numofbori') . "-" . $this->storages()->sum('numoftora');
    }
    public function sold()
    {
        // return $this->sales()->sum('numofbori') . "-" . $this->sales()->sum('numoftora');
    }
}