<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'store_id',
        'numofbori',
        'numoftora',
        'note',
    ];
}