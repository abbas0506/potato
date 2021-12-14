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
}