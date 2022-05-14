<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Practice
 *
 * @property int                             $id
 * @property string                          $name
 * @property int                             $practice_date_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Practice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Practice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Practice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Practice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practice wherePracticeDateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practice whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Practice extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'id',
            'name',
            'practice_date_id',
        ];

}
