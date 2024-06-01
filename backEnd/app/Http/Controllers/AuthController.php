<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user exists and if the provided password is correct
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Generate an API token
            $token = $user->createToken('API Token')->plainTextToken;

            // Return a response with the token
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ], 200);
        }
        return response()->json([
            'message' => 'Invalid email or password',
        ], 401);
    }
    public function register(Request $request){
        // Validate the incoming request
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
        ]);

        // Generate an API token
        $token = $user->createToken('API Token')->plainTextToken;

        // Return a response with the token
        return response()->json([
           'message' => 'Registration successful',
            'token' => $token,
            'user' => $user,
        ], 201);
    }


    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ]);
    }
}
