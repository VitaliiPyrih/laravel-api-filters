<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function __invoke(RegistrationRequest $request)
    {
        $data = $request->validated();

        $token = [
          'admin' => ['create','update','delete'],
          'creator' => ['create','update'],
          'guest' => ['base'],
        ];

        $role = array_key_exists($request->role,$token) ?  $request->role : $request->role = 'guest';

        $data['role'] = $role;

        $user = \App\Models\User::create($data);

        $token = $user->createToken("$role-token",$token[$role]);



        $response = [
            'user' => $user,
            'token' => $token->plainTextToken
        ];

        return response($response,401);
    }
}
