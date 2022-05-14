<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Organization
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organization query()
 * @mixin \Eloquent
 */
class Organization extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'id',
            'name',
            'description',
            'email',
            'phone',
            'user_id',
        ];

}
