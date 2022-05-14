<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Stack
 *
 * @property int         $id
 * @property string      $name
 * @property string      $url
 * @property string      $photo
 * @property int         $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Stack newModelQuery()
 * @method static Builder|Stack newQuery()
 * @method static Builder|Stack query()
 * @method static Builder|Stack whereCreatedAt($value)
 * @method static Builder|Stack whereId($value)
 * @method static Builder|Stack whereName($value)
 * @method static Builder|Stack wherePhoto($value)
 * @method static Builder|Stack whereUpdatedAt($value)
 * @method static Builder|Stack whereUrl($value)
 * @method static Builder|Stack whereUserId($value)
 * @mixin \Eloquent
 */
class Stack extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'id',
            'name',
            'url',
            'photo',
            'user_id',
        ];

}
