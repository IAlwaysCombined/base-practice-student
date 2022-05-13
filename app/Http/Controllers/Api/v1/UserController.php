<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ApiHelper;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use PhpParser\Builder;

class UserController extends BaseController
{
    //Get user data
    public function me(){
        return User::getUser();
    }
    //Get Portfolio User
    public function portfolioUser(): JsonResponse|\Illuminate\Database\Eloquent\Builder
    {
        try {
            return Portfolio::query()->where('user_id', User::getUserId());
//            if ($user == 0){
//                return Portfolio::where('user_id', User::getUserId());
//            } else{
//                return Portfolio::where('user_id', $user);
//            }
        }catch (\Exception $e){
            return ApiHelper::sendError($e);
        }
    }

}
