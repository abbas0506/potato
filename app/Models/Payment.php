<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'seller_id',
        'deal_id',
        'paid',
        'paymode',
        'note',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    //public $timestamps = false;
}