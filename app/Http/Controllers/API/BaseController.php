<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Handle a json request.
     *
     * @param ?mixed $data to return
     * @param ?string $msg optional message to give
     * @return JsonResponse json object response
     */
    public function handleResponse(mixed $data = null, ?string $msg = null): JsonResponse
    {
        $result = [
            "success" => true
        ];

        // set data if provided
        if (isset($data)) $result["data"] = $data;

        // set message if provided
        if (isset($msg)) $result["message"] = $msg;

        return response()->json($result);
    }

    /**
     * Handle a json Errored request.
     *
     * @param string $error error message
     * @param ?array $errorMsgs array of messages (for example, validation errors)
     * @param ?int $code type of response
     * @return JsonResponse json object response
     */
    public function handleError(string $error, array $errorMsgs = [], int $code = 500): JsonResponse
    {
        $result = [
            "success" => false,
            "message" => $error
        ];

        if (!empty($errorMsgs)) $result["data"] = $errorMsgs;

        return response()->json($result, $code ?? 500);
    }
}
