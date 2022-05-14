<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\SpecialityPractice
 *
 * @property int         $speciality_id
 * @property int         $practices_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialityPractice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialityPractice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialityPractice query()
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialityPractice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialityPractice wherePracticesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialityPractice whereSpecialityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SpecialityPractice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SpecialityPractice extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'speciality_id',
            'practices_id',
        ];

}
