<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compatibility extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function firstName()
    {
        return $this->belongsTo(Translation::class, 'first_id', 'id');
    }

    public function secondName()
    {
        return $this->belongsTo(Translation::class, 'second_id', 'id');
    }

    public function getFirstNameAttribute()
    {
        $translation = $this->firstName()->first();
        $temp = json_decode($translation->name, true);
        return $temp['main'];
    }

    public function getSecondNameAttribute()
    {
        $translation = $this->secondName()->first();
        $temp = json_decode($translation->name, true);
        return $temp['main'];
    }

    public function getCompatibilityPercentageAttribute()
    {
        if (empty($this->compatibility)) {
            return 0;
        } else {
            return $this->compatibility . '%';
        }
    }
}
