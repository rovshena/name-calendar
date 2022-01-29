<?php

namespace App\Models;

use App\Traits\HasStatusAttribute;
use App\Traits\HasStatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, HasStatusScope, HasStatusAttribute;

    protected $guarded = ['id'];
}
