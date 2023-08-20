<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function show($id)
    {
        $user = User::with('projects.tasks')->find($id);
        Log::info('test1');
        Log::info($id);
        Log::info('test2');
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $user;
        // return response()->json($user);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function showCurrentAuthenticatedUser(Request $request)
    {
        Log::info($request->user());
        return $request->user(); // or any other logic to get the currently authenticated user.
    }
}
