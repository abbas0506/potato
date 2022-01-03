<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyerpayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'buyer_id',
        'paid',
        'mode',
        'note',
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }
}