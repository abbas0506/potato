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

    public function picked()
    {
        $numofbori_picked = $this->purchases->sum('numofbori');
        $numoftora_picked = $this->purchases->sum('numoftora');
        return $numofbori_picked . " + " . $numoftora_picked;
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
        $numofbori_picked = $this->purchases->sum('numofbori');
        $numoftora_picked = $this->purchases->sum('numoftora');
        //agreed - picked
        $numofbori_left = $this->numofbori - $numofbori_picked;
        $numoftora_left = $this->numoftora - $numoftora_picked;
        return $numofbori_left . " + " . $numoftora_left;
    }
}