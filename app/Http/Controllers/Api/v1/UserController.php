<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;

class UserController extends BaseController
{
    //Get user data
    public function me(){
        return User::getUser();
    }

}
