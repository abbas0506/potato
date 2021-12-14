<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'client_id',
        'product_id',
        'numofbori',
        'numoftora',
        'unitprice',
        'commission',
        'dateon',
    ];

    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
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
    public function stored()
    {
        //return $this->storages()->sum('numofbori') . "-" . $this->storages()->sum('numoftora');
    }
    public function sold()
    {
        // return $this->sales()->sum('numofbori') . "-" . $this->sales()->sum('numoftora');
    }
    public function left()
    {
        // $numofbori_purchased = $this->numofbori;
        // $numoftora_purchased = $this->numoftora;
        // $numofbori_sold = $this->storages()->sum('numofbori');
        // $numoftora_sold = $this->storages()->sum('numoftora');
        // $numofbori_stored = $this->sales()->sum('numofbori');
        // $numoftora_stored = $this->sales()->sum('numoftora');
        // $numofbori_stock = $numofbori_purchased - $numofbori_sold - $numofbori_stored;
        // $numoftora_stock = $numoftora_purchased - $numoftora_sold - $numoftora_stored;
        // return $numofbori_stock . "-" . $numoftora_stock;
    }
}