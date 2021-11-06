<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function init()
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    public function login(Request $request)
    {
        return $this->authenticate([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);
    }

    public function register(UserRequest $request)
    {

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return $this->authenticate([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => \auth('api')->user()
        ]);
    }

    private function authenticate($credentials)
    {
        if ($token = auth('api')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }
        return response()->json([
            'message' => 'Invalid Username of password'
        ], 401);
    }
}
