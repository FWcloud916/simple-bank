<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Traits\ApiTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiTrait;

    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $user = Auth::user();
        $token = $user->createToken('apiToken')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token,
        ];

        return $this->successResponse(
            'User logged in successfully',
            $data
        );
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return $this->successResponse('Logged out.');
    }
}
