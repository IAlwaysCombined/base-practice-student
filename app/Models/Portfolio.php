<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'url',
        'user_id'
    ];

    /**
     * Return the user's photo in portfolio
     */
    public function photo(): BelongsToMany
    {
        return $this->belongsToMany(Photo::class);
    }

}
