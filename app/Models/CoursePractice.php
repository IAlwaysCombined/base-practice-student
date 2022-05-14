<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\CoursePractice
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice query()
 * @mixin \Eloquent
 * @property int         $courses_id
 * @property int         $practices_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice whereCoursesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice wherePracticesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoursePractice whereUpdatedAt($value)
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
