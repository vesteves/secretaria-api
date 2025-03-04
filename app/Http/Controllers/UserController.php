<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;

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
            'name' => ['required'],
            'profile' => ['required'],
        ]);

        $user = User::create($credentials);

        $token = $user->createToken('auth');

        return response()->json([
            "token" => $token
        ]);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUser $request)
    {
        $user = User::create($request->all());

        return response()->json([
            "msg" => "Usuário criado!",
            "data" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUser $request, User $user)
    {
        $user->update($request->all());

        // TODO colocar em um log de alterações quais campos e quem alterou

        return response()->json([
            "msg" => "Usuário atualizado!",
            "data" => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            "msg" => "Usuário removido!"
        ]);
    }
}
