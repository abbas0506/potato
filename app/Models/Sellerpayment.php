<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sellerpayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'deal_id',
        'seller_id',
        'paid',
        'mode',
        'note',
    ];

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}