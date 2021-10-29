<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'fee'
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'section_id');
    }
    public $timestamps = false;
}