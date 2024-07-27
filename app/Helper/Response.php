<?php

namespace App\Helper;

class Response
{

    public static function success($data = null, $message = 'success', $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'status_code' => $statusCode,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }

    public static function error($message = 'error', $statusCode = 400, $data = null)
    {
        return response()->json([
            'status' => 'error',
            'status_code' => $statusCode,
            'data' => $data,
            'message' => $message,
        ], $statusCode);
    }
}
