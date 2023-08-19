<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //
    // public function login(Request $request)
    // {
    //     Log::info($request->all());
    //     $credentials = $request->only('email', 'password');

    //     if (!Auth::attempt($credentials)) {
    //         return response()->json(['message' => 'Invalid login details'], 401);
    //     }

    //     $user = User::where('email', $request->email)->first();

    //     $token = $user->createToken('authToken')->plainTextToken;

    //     return response()->json(['token' => $token]);
    // }

    public function login(Request $request)
    {
        Log::info($request->all());
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'Login successful']);
    }
}
