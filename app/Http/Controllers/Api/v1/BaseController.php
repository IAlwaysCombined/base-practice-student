<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BaseController extends Controller
{
    public function sendResponse($result = null, string $message = '', bool $mergeResult = false): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        return response()->json($mergeResult ? array_merge($response, $result) : [
                'data' => $result,
            ] + $response);
    }

    /**
     * success auth method.
     *
     * @param $token
     * @param $userRole
     * @param $userId
     * @param $message
     *
     * @return JsonResponse
     */
    public function sendAuth($token, $userRole, $userId, $message): JsonResponse
    {
        return response()->json([
            'success'      => true,
            'token'        => $token,
            'userRole'     => $userRole,
            'userId'       => $userId,
            'message'      => $message,
        ]);
    }
}
