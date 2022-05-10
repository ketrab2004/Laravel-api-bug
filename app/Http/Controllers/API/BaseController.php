<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Handle a json request.
     *
     * @param mixed $result what to return
     * @param ?string $msg optional message to give
     * @return \Illuminate\Http\JsonResponse json object response
     */
    public function handleResponse(mixed $result, ?string $msg): \Illuminate\Http\JsonResponse
    {
        $result = [
            "success" => true,
            "data" => $result
        ];

        // set message if provided
        if (isset($msg)) $result["message"] = $msg;

        return response()->json($result);
    }

    /**
     * Handle a json Errored request.
     *
     * @param string $error error message
     * @param array $errorMsgs array of php error message?
     * @param ?int $code type of response
     * @return \Illuminate\Http\JsonResponse json object response
     */
    public function handleError(string $error, array $errorMsgs = [], int $code = 500): \Illuminate\Http\JsonResponse
    {
        $result = [
            "success" => false,
            "message" => $error
        ];

        if (!empty($errorMsgs)) $result["data"] = $errorMsgs;

        return response()->json($result, $code ?? 500);
    }
}
