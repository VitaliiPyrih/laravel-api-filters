<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $token[Auth::user()->role] ?? $token['guest'];

            $response = [
                'user' => Auth::user(),
                'token' => $token->plainTextToken
            ];

            return response($response);
        }

        return response(['message' => 'wrong password or email'],401);
    }
}
