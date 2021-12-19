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
        'grossweight',
        'unitprice',
        'commission',
        'bagscost',
        'selectorcost',
        'packingcost',
        'loadingcost',
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

    public function stored()
    {
        return $this->storages()->sum('numofbori') . "-" . $this->storages()->sum('numoftora');
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



    public function sold()
    {
        return $this->sales()->sum('numofbori') . "-" . $this->sales()->sum('numoftora');
    }
    public function left()
    {
        $numofbori_purchased = $this->numofbori;
        $numoftora_purchased = $this->numoftora;
        $numofbori_sold = $this->storages()->sum('numofbori');
        $numoftora_sold = $this->storages()->sum('numoftora');
        $numofbori_stored = $this->sales()->sum('numofbori');
        $numoftora_stored = $this->sales()->sum('numoftora');
        $numofbori_stock = $numofbori_purchased - $numofbori_sold - $numofbori_stored;
        $numoftora_stock = $numoftora_purchased - $numoftora_sold - $numoftora_stored;
        return $numofbori_stock . "-" . $numoftora_stock;
    }
}
