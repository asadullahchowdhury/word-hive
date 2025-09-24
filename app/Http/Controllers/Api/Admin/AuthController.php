<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // check if already logged in
        if (cache()->has('admin_token')) {
            return response()->json([
                'token' => cache('admin_token'),
                'message' => 'Already logged in',
            ], 401);
        }

        // validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = config('admin');

        // check credentials
        if ($request->email === $admin['email'] && $request->password === $admin['password']) {
            $token = base64_encode(Str::random(10));
            cache()->put('admin_token', $token, now()->addHours(2));

            return response()->json([
                'message' => 'Logged in successfully!',
                'token' => $token
            ]);
        }

// invalid credentials
        return response()->json(['message' => 'Invalid credentials'], 401);
    }


    public function logout()
    {
        // check if already logged out
        if (!cache('admin_token')) {
            return response()->json(['message' => 'Already logged out or invalid token'], 401);
        }

        // logout
        cache()->forget('admin_token');

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }


    public function me(Request $request)
    {
        return response()->json([
            'name' => config('admin.name'),
            'email' => config('admin.email'),
            'status' => 'authenticated'
        ]);
    }
}
