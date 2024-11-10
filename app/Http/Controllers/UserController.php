<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials["email"])->first();

        if (!$user) {
            return response()->json([
                "msg" => "Usuário não encontrado"
            ], 404);
        }
        $token = $user->createToken('auth');

        return response()->json([
            "token" => $token
        ]);
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::create($credentials);

        $token = $user->createToken('auth');

        return response()->json([
            "token" => $token
        ]);
    }

    public function test()
    {
        return response()->json(Auth::user());
    }
}
