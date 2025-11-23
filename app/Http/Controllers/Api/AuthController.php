<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    public function login(Request $request){
        $request->validate(
           [
             'email'=>'required',
             'password'=>'required'
           ]
        );

        $user=User::where('email',$request->email)->first();
        if(!Hash::check($request->password,$user->password)){
               throw ValidationException::withMessages([
                'email'=>['The email credentials are incorrect']
               ]);
        }

        if(!$user){
            throw ValidationException::withMessages(
                [
                  'email'=>['The password credentials are incorrect']
                 
                ]
            );
        }
        $token=$user->createToken('api-token')->plainTextToken;
        return response()->json([

            'token'=>$token,
            "user"=>$user

        ]);
    
    
    
    }


    public function Register(Request $request){

   // ✅ Validate incoming data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
    ]);

    // ✅ Hash the password
    $validatedData['password'] = Hash::make($request->password);

    // ✅ Create the user
    $user=User::create($validatedData);

    $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            
            'token' => $token,
            'user' => $user,
        ], 201);
    }
   public function logout(Request $request)
{
    
    $request->user()->tokens()->delete();

    return response()->json([
        "message" => "Logged out from all devices successfully"
    ]);
}

}
