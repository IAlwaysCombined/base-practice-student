<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;

/**
 * App\Models\User
 *
 * @property int                                                        $id
 * @property string                                                     $name
 * @property string|null                                                $surname
 * @property string|null                                                $patronymic
 * @property string                                                     $email
 * @property string|null                                                $phone
 * @property string|null                                                $bday
 * @property string|null                                                $avatar
 * @property Carbon|null                                                $email_verified_at
 * @property string                                                     $password
 * @property int|null                                                   $course
 * @property int                                                        $role_id
 * @property int|null                                                   $speciality_id
 * @property string|null                                                $remember_token
 * @property Carbon|null                                                $created_at
 * @property Carbon|null                                                $updated_at
 * @property-read Collection|Client[]                                   $clients
 * @property-read int|null                                              $clients_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null                                              $notifications_count
 * @property-read Collection|Token[]                                    $tokens
 * @property-read int|null                                              $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSpecialityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'id',
            'name',
            'surname',
            'patronymic',
            'email',
            'course',
            'role_id',
            'speciality_id',
            'phone',
            'bday',
            'avatar',
            'password',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    public static function getUser(): \Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }

    public static function getUserId(): int
    {
        return (int) self::getUser()
            ->getAuthIdentifier();
    }

    /**
     * @throws Exception
     */
    public static function getLoggedInUser(): User
    {
        $user = Auth::user();

        if ( ! $user) {
            throw new Exception('missing logged in user');
        }

        return $user;
    }

    /**
     * @throws Exception
     */
    public static function processAvatarUploading(
        Request $request,
        User $user = null,
        bool $isAvatarRequired = true
    ): void {
        //TODO Delete avatar folder before setting new photo
        $image = $request->file('avatar');

        switch (true) {
            case $image && $image->isValid():
                $file_name = Str::random(40).'.'.$image->extension();

                if ( ! $user) {
                    $user = self::getLoggedInUser();
                }

                $userAvatarFolderPath
                    = "images/{$user->getAuthIdentifier()}/avatar";

                $image->move(public_path($userAvatarFolderPath), $file_name);

                $user->avatar = "/{$userAvatarFolderPath}/{$file_name}";
                $user->update();
                break;
            case $isAvatarRequired:
                throw new Exception('empty_file');
        }
    }

    public function deleteAvatar(): bool
    {
        File::delete(public_path().$this->avatar);

        $this->avatar = null;

        return true;
    }

}
