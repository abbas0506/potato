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
    protected $dates = ['dateon'];
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
    public function payments()
    {
        return $this->hasMany(Sellerpayment::class, 'deal_id');
    }

    //QTY
    public function qty()
    {
        return $this->numofbori . "+" . $this->numoftora;
    }


    // PICK
    public function numofbori_picked()
    {
        return $this->purchases()->sum('numofbori');
    }
    public function numoftora_picked()
    {
        return $this->purchases()->sum('numoftora');
    }

    public function picked()
    {
        return $this->numofbori_picked() . "+" . $this->numoftora_picked();
    }

    // STORED
    public function numofbori_stored()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->storages()->sum('numofbori') - $purchase->exports()->sum('numofbori') - $purchase->wastes()->sum('numofbori');
        });
    }
    public function numoftora_stored()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->storages()->sum('numoftora') - $purchase->exports()->sum('numoftora') - $purchase->wastes()->sum('numoftora');
        });
    }
    public function stored()
    {
        return $this->numofbori_stored() . "+" . $this->numoftora_stored();
    }


    // SALE
    public function numofbori_sold()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->sales()->sum('numofbori');
        });
    }
    public function numoftora_sold()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->sales()->sum('numoftora');
        });
    }

    public function sold()
    {
        return $this->numofbori_sold() . "-" . $this->numoftora_sold();
    }

    // WASTED

    public function numofbori_wasted()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->wastes->sum('numofbori');
        });
    }
    public function numoftora_wasted()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->wastes->sum('numoftora');
        });
    }
    public function wasted()
    {
        return $this->numofbori_wasted() . "-" . $this->numoftora_wasted();
    }

    // LEFT

    public function numofbori_left()
    {
        return $this->numofbori - $this->numofbori_picked();
    }
    public function numoftora_left()
    {
        return $this->numoftora - $this->numoftora_picked();
    }
    public function left()
    {
        return $this->numofbori_left() . "-" . $this->numoftora_left();
    }

    // payable
    public function bill()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->basicprice();
        });
    }
    public function paid()
    {
        return $this->payments->sum('paid');
    }
}