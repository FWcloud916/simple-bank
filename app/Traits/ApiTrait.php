<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiTrait
{
    public function successResponse($message, $data = [], $code = Response::HTTP_OK): JsonResponse
    {
        return $this->apiResponse(true, $message, $data, $code);
    }

    public function apiResponse($success = true, $message = '', $data = [], $status = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => $success,
            'message' => 'ok',
        ];

        if ($data) {
            $response['data'] = $data;
        }

        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response, $status);
    }
}
