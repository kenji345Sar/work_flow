<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function show($id)
    {
        $user = User::with('projects.tasks')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return $user;
        // return response()->json($user);
    }
}
