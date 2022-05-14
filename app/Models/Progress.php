<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Progress
 *
 * @property int         $id
 * @property string      $name
 * @property int         $rating
 * @property int         $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Progress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Progress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Progress query()
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Progress whereUserId($value)
 * @mixin \Eloquent
 */
class Progress extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'id',
            'name',
            'rating',
            'user_id',
        ];

}
