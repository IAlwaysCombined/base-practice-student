<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'start_date',
        'end_date'
    ];

}
