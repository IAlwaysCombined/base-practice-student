<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiHelper
{
    public static function sendError($error, string $customMessage = ''): JsonResponse
    {
        $response = [
            'success'       => false,
            'message'       => $error instanceof Exception ? $error->getMessage() : $error,
            'customMessage' => $customMessage
        ];

        return response()->json($response, 400);
    }

    public static function getFormValidationErrorsResponse(array $finalMessages): JsonResponse
    {
        return self::sendError(implode(', ', $finalMessages), 'form_validation_errors');
    }
}
