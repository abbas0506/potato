<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Storage extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'store_id',
        'numofbori',
        'numoftora',
        'cost_id',
        'dateon',
    ];
    protected $dates = ['dateon'];
    public $timestamps = false;

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function exports()
    {
        return Sale::where('purchase_id', $this->purchase_id)->where('store_id', $this->store_id);
    }
    public function exported()
    {
        return $this->exports()->sum('numofbori') . "+" . $this->exports()->sum('numoftora');
    }
    public function wastes()
    {
        return Waste::where('purchase_id', $this->purchase_id)->where('store_id', $this->store_id);
    }
    public function wasted()
    {
        return $this->wastes()->sum('numofbori') . "+" . $this->wastes()->sum('numoftora');
    }
    public function numofbori_wasted()
    {
        return $this->wastes()->sum('numofbori');
    }
    public function numoftora_wasted()
    {
        return $this->wastes()->sum('numoftora');
    }
    public function cost()
    {
        return $this->belongsTo(Cost::class, 'cost_id');
    }
    public function storage()
    {
        return $this->numofbori * $this->cost->storage0 + $this->numoftora * $this->cost->storage1;
    }
    public function left()
    {
        $numofbori_left = $this->numofbori - $this->numofbori_wasted();
        $numoftora_left = $this->numoftora - $this->numoftora_wasted();
        return $numofbori_left . "+" . $numoftora_left;
    }
}