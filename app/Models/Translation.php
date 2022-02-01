<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function firstCompatibilities()
    {
        return $this->hasMany(Compatibility::class, 'first_id', 'id');
    }

    public function secondCompatibilities()
    {
        return $this->hasMany(Compatibility::class, 'second_id', 'id');
    }
}
