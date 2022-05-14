<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Portfolio
 *
 * @property int                     $id
 * @property string                  $name
 * @property string                  $description
 * @property string                  $url
 * @property int                     $user_id
 * @property Carbon|null             $created_at
 * @property Carbon|null             $updated_at
 * @property-read Collection|Photo[] $photo
 * @property-read int|null           $photo_count
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Portfolio whereUserId($value)
 * @mixin \Eloquent
 */
class Portfolio extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'id',
            'name',
            'description',
            'url',
            'user_id',
        ];

    /**
     * Return the user's photo in portfolio
     */
    public function photo(): BelongsToMany
    {
        return $this->belongsToMany(Photo::class);
    }

}
