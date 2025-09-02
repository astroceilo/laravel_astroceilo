<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'hospital_id'
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
