<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

function successResponse($message = null, $data = [], $status = Response::HTTP_OK): JsonResponse
{
    return response()->json([
        'message' => $message,
        'data' => $data,
    ])->setStatusCode($status);
}

function failedResponse($message = null, $errors = [], $status = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
{
    return response()->json([
        'message' => $message,
        'errors' => $errors
    ])->setStatusCode($status);
}
