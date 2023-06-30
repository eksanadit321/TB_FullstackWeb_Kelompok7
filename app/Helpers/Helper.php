<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class Helper
{
    public static function toJson($data = null, $message = 'ok', $status = true, $code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'result' => $data,
        ], $code);
    }
}