<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class ApiController extends Controller
{

    public function errorResponse($message, $exception, $code = 417)
    {
        return $this->response('error', $message, $code, null, $exception);
    }

    public function successResponse($message, $code = 200)
    {
        return $this->response('success', $message, $code);
    }

    public function dataResponse($message, $data, $code = 200)
    {
        return $this->response('success', $message, $code, $data);
    }

    public function response($status, $message, $code, $data = null, $exception = null)
    {
        if ($exception) {
            Log::error($exception);
        }

        $payload = [
            'status' => $status,
            'message' => $message
        ];

        if ($data) {
            $payload['data'] = $data;
        }

        return response()->json($payload, $code);
    }
}
