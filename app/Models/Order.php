<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int         $id
 * @property string      $date
 * @property int         $is_check
 * @property int         $student_id
 * @property int         $practice_id
 * @property int         $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereIsCheck($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePracticeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
class Order extends Model
{

    use HasFactory;

    protected $fillable
        = [
            'id',
            'date',
            'is_check',
            'student_id',
            'practice_id',
            'company_id',
        ];

    /**
     * The attributes that should be cast.
     * @var array
     */
    protected $casts = [
        'is_check' => 'boolean'
    ];

}
