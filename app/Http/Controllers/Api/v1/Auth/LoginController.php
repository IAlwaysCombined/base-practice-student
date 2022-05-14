<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Api\v1\BaseController;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends BaseController
{

    public function login(Request $request): JsonResponse
    {
        try {
            $user = User::where('email', $request->get('email'))
                ->firstOrFail();

            if ( ! $user
                || ! Hash::check($request->password, $user->password)
            ) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect'],
                ]);
            }
            $user->save();

            return $this->sendAuth(
                $user->createToken('Auth Token')->accessToken,
                $user->role_id,
                $user->id,
                'User login successfully.');
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

    public function logout(Request $request
    ): Response|JsonResponse|Application|ResponseFactory {
        try {
            $token = $request->user()
                ->token();
            $token->revoke();
            $response = ['message' => 'You have been successfully logged out!'];

            return response($response, 200);
        } catch (Exception $e) {
            return ApiHelper::sendError($e);
        }
    }

}
