<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'numofbori',
        'numoftora',
        'transporter_id',
        'vehicleno',
        'carriage',
        'storagecost',
        'note',
        'dateon',
    ];

    public $timestamps = false;
}