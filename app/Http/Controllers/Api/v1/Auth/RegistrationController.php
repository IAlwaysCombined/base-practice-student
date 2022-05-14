<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Api\v1\BaseController;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends BaseController
{

    public function registerStudent(Request $request): ?JsonResponse
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
                'speciality_id'     => 'required',
                'course'            => 'required'
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
                'role_id'            => 1,
                'speciality_id'      => $request->get('speciality_id'),
                'course'             => $request->get('course'),
            ]);

            if ($isForEmail) {
                event(new Registered($user));
            } else {
                Notification::send($user, new SendCodePhoneNotification);
            }

            return $this->sendAuth(
                $user->createToken('Auth Token')->accessToken,
                $user->role_id,
                $user->id,
                "User registration with {$registerMethodName} successfully.");
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

}
