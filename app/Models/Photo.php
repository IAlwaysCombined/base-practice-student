<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'url',
        'user_id'
    ];

    /**
     * @throws Exception
     */
    public static function createPhoto(Request $request, string $folderName): Photo
    {
        $userId = User::getUserId();
        $image = $request->file('url');
        $photo = new Photo();
        $photo->user_id = $userId;
        if ($image && $image->isValid()) {
            $file_name = Str::random(40) . '.' . $image->extension();

            $image->move(public_path("images/$userId/{$folderName}"), $file_name);

            $photo->url = "/images/$userId/{$folderName}/$file_name";
            $photo->save();
        } else {
            throw new Exception('empty_file');
        }

        return $photo;
    }


}
