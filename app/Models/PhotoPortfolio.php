<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PhotoPortfolio
 *
 * @property int         $portfolio_id
 * @property int         $photo_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoPortfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoPortfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoPortfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoPortfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoPortfolio wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoPortfolio wherePortfolioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoPortfolio whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PhotoPortfolio extends Model
{

    use HasFactory;

    protected $table = 'photo_portfolio';

    protected $fillable
        = [
            'portfolio_id',
            'photo_id',
        ];

}
