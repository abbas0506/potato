<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'deal_id',
        'seller_id',
        'paid',
        'mode',
        'note',
    ];

    //public $timestamps = false;

}