<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    protected $fillable = [
        'selector',
        'sorting',
        'commission0',
        'commission1',
        'bagprice0',
        'bagprice1',
        'packing0',
        'packing1',
        'loading0',
        'loading1',
        'carriage0',
        'carriage1',
        'storage0',
        'storage1',
        'sadqa',
        'random',
        'note',
    ];

    public $timestamps = false;
}