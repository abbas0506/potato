<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'store_id',
        'transporter_id',
        'vehicleno',
        'numofbori',
        'numoftora',
        'carriage',
        'storagecost',
        'note',
        'dateon',
    ];

    public $timestamps = false;

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function transporter()
    {
        return $this->belongsTo(Transporter::class, 'transporter_id');
    }
    public function exports()
    {
        return Sale::where('purchase_id', $this->purchase_id)->where('store_id', $this->store_id);
    }
    public function exported()
    {
        return $this->exports()->sum('numofbori') . "+" . $this->exports()->sum('numoftora');
    }
    public function wastes()
    {
        # code...
    }
    public function wasted()
    {
        # code...
    }
}