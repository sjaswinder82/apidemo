<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request) {
        $params = $request->only('name', 'email');
        $params['password'] = bcrypt($request->input('password'));
        $user = User::create($params);

        return response()->json(['message' => 'register successfully']);
    }
}
