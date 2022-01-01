<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'address',
    ];

    public function deals()
    {
        return $this->hasMany(Deal::class, 'seller_id');
    }

    public $timestamps = false;
}