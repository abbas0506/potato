<?php

namespace App\Models;

use App\Http\Controllers\SaleController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'address',
    ];

    public $timestamps = false;

    public function sales()
    {
        return $this->hasMany(Sale::class, 'buyer_id');
    }
    public function payments()
    {
        return $this->hasMany(Buyerpayment::class, 'buyer_id');
    }
    public function bill()
    {
        return $this->sales->sum('saleprice');
    }
    public function paid()
    {
        return $this->payments->sum('paid');
    }
}