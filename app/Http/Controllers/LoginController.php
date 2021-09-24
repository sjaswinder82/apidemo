<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if(! $token  = auth()->attempt($credentials)){
            return response()->json([
                'message' => 'invalid credentials',
            ], 422);
        }

        return response()->json([
            'access_token' => $token,
        ], 200);
    }
}
