<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'user' => new UserResource(auth()->user()),
                'token' => auth()->user()->createToken('api-token')->plainTextToken,
            ]);
        }

        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
    }
}
