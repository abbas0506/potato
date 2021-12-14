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
    // public function client()
    // {
    //     return $this->deal()->client();
    // }

    // public function product()
    // {
    //     return $this->deal()->product();
    // }
    public function storages()
    {
        return $this->hasMany(Storage::class, 'purchase_id');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'purchase_id');
    }
    public function stored()
    {
        return $this->storages()->sum('numofbori') . "-" . $this->storages()->sum('numoftora');
    }
    public function sold()
    {
        return $this->sales()->sum('numofbori') . "-" . $this->sales()->sum('numoftora');
    }
    public function stock()
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