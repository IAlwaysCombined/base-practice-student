<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CoursePractice
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice query()
 * @mixin \Eloquent
 */
class CoursePractice extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'courses_id',
            'practices_id',
        ];

}
