<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiTrait;

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'account' => $request->account,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;

        return $this->successResponse(
            'User registered successfully',
            [
                'user' => $user,
                'token' => $token,
            ],
        );
    }

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
