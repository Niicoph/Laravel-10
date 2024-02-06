<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException as ValidationException;


class AuthController extends Controller {
    
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = \App\Models\User::where('email' , $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
              ]);
        }
     // if the password hashed from db is not the same as the hashed password introduced from input 
        if (!Hash::check($request->password , $user->password) ) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
              ]);  // we dont specify for password for security reasons 
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);

    }
    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

}
