<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Api\v1\BaseController;
use App\Models\User;
use App\Notifications\SendCodePhoneNotification;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegistrationController extends BaseController
{

    public function registerWithEmail(Request $request): ?JsonResponse
    {
        return $this->registerUser($request, true);
    }

    protected function registerUser(Request $request, bool $isForEmail): JsonResponse
    {
        if ($isForEmail) {
            $registerMethodName  = 'email';
            $extraValidationRule = '|unique:users';
        } else {
            $registerMethodName  = 'phone';
            $extraValidationRule = '';
        }

        try {
            $validator = Validator::make($request->all(), [
                $registerMethodName => "required{$extraValidationRule}",
                'name'              => 'required',
                'surname'           => 'required',
                'password'          => 'required',
            ]);

            if ($validator->fails()) {
                return ApiHelper::getFormValidationErrorsResponse($validator->errors()
                    ->all());
            }

            $user = User::create([
                $registerMethodName  => $request->get($registerMethodName),
                'name'               => $request->get('name'),
                'surname'            => $request->get('surname'),
                'password'           => bcrypt($request['password']),
            ]);

            if ($isForEmail) {
                event(new Registered($user));
            } else {
                Notification::send($user, new SendCodePhoneNotification);
            }

            return $this->sendAuth(
                $user->createToken('Auth Token')->accessToken,
                "",
                $user->id,
                "User registration with {$registerMethodName} successfully.");
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

}
