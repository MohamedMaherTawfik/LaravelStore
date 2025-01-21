<?php

namespace App\Http\Controllers\api;

trait apiResponse
{
    public function apiResponse($data = null, $message = null, $status = null,)
    {
        $array = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response($array);
    }
}
