<?php

namespace App\Http\Controllers\api;

trait apiResponseusers
{
    public function apiResponse($data = null, $message = null, $status = null, $token = null)
    {
        $array = [
            'status' => $status,
            'token' => $token,
            'message' => $message,
            'data' => $data
        ];
        return response($array);
    }
}
