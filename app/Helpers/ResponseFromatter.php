<?php
 namespace App\Helpers;

class ResponseFromatter
{
    public static function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message,
            'code' => $code
        ]);
    }

    public static function error($message = 'error', $code = 500)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'code' => $code
        ],$code);
    }
}
