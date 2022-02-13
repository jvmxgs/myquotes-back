<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\RegisterStoreRequest;
use App\Models\User;


class RegisterController extends ApiController
{

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterStoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('QuoteToken')->accessToken;

        return $this->dataResponse('Registered successfully', [
            'user' => $user,
            'token' => $token
        ]);
    }
}
