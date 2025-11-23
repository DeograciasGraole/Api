<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function googleLogin(Request $request)
{
    try {
        $idToken = $request->token;

        // Verify the token with Google
        $payload = json_decode(
            file_get_contents("https://oauth2.googleapis.com/tokeninfo?id_token=$idToken"),
            true
        );

        if (!isset($payload["email"])) {
            return response()->json(["error" => "Invalid Google Token"], 401);
        }

        // Create or get user
        $user = User::firstOrCreate(
            ['email' => $payload["email"]],
            [
                'name' => $payload["name"] ?? "Unknown User",
                'password' => Hash::make(Str::random(12)),
            ]
        );

        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "token" => $token,
            "user" => $user,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            "error" => "Google sign in failed",
            "message" => $e->getMessage()
        ], 500);
    }
}


}
