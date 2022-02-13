<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\LoginRequest;

class LoginController extends ApiController
{

    /**
     * Login method
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response(['error_message' => 'Incorrect Details.
            Please try again']);
        }

        $token = auth()->user()->createToken('QuoteToken')->accessToken;

        return $this->dataResponse('Logged in successfully', ['user' => auth()->user(), 'token' => $token]);
    }
}
