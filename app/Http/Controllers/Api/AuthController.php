<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function AuthLogin(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthorized! User tidak ditemukan'
            ], 401);
        }
1
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login Success',
            'data' => [
                'users' => $user,
                'token' => $token
            ]
        ]);
    }


    public function AuthLogout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response()->json('Logout successfull');
    }
}
