<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    // Method for user registration
    public function register(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            "name"              => "required|string|max:255",
            "email"             => "required|string|email|max:255|unique:users",
            "password"          => "required|string|min:8",
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }

        // Create user and hash the password
        $user = User::create([
            "name"              => $request->name,
            "email"             => $request->email,
            "password"          => Hash::make($request->password),
        ]);

        // Create token
        $token = $user->createToken("auth_token")->plainTextToken;

        // Respond with success
        return response()->json([
            "data"              => $user,
            "access_token"      => $token,
            "token_type"        => "Bearer",
        ], 201);
    }

    // Method for user login
    public function login(Request $request)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            "email"             => "required|string|email",
            "password"          => "required",
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }

        // Attempt to authenticate the user
        if (!Auth::attempt($request->only("email", "password"))) {
            return response()->json(["message" => "Unauthorized"], 401);
        }

        // Get the authenticated user (already authenticated by Auth::attempt)
        $user = Auth::user();

        // Generate token
        $token = $user->createToken("auth_token")->plainTextToken;

        // Respond with user details and token
        return response()->json([
            "message"           => "Hi $user->name, welcome back!",
            "access_token"      => $token,
            "token_type"        => "Bearer",
            "user"              => $user,
        ], 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return ["message"=> "You have successfully logged out and the token was successfully deleted"];
    }
}
