<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoPortfolio extends Model
{
    use HasFactory;

    protected $table = 'photo_portfolio';

    protected $fillable = [
        'portfolio_id',
        'photo_id'
    ];

}
