<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fee'
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'group_id');
    }
    public $timestamps = false;
}