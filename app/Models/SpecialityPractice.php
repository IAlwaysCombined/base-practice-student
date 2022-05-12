<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialityPractice extends Model
{
    use HasFactory;

    protected $fillable = [
        'speciality_id',
        'practices_id'
    ];

}
