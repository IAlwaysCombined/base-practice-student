<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PracticeDate
 *
 * @property int         $id
 * @property string      $start_date
 * @property string      $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeDate query()
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeDate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeDate whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeDate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeDate whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PracticeDate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PracticeDate extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'id',
            'start_date',
            'end_date',
        ];

}
