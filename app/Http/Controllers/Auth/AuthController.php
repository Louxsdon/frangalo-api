<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $credientials = $request->validate([
            "email" => "required|email",
            "password" => "required|string|max:255",
        ]);

        if (Auth::attempt($credientials, $request->rememberMe)) {
            $user = User::where("email", $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "token" => $token,
                "user" => $user
            ]);
        };

        return response()->json([
            'message' => 'Incorrect email or password',
        ], 400);
    }


    public function logout(Request $request)
    {

        $request->user()->accessToken()->delete();

        return response()->json([
            "message" => "Logout successful"
        ]);
    }
}
