<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $vld = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if($vld->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $vld->messages()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'active'
        ]);

        $token = $user->createToken('userToken')->plainTextToken;

        return response()->json([
            'message' => 'register success',
            'token' => $token,
            'user' => $user
        ], 201);
        
    }

    public function login(Request $request) {
        $vld = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]); 

        if($vld->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'error' => $vld->messages()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if(!$user || ! Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Wrong email or password'
            ], 401);
        }

        $token = $user->createToken('myToken')->plainTextToken;

        return response()->json([
            'message' => 'login success',
            'token' => $token,
            'user' => $user
        ], 200);
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout Success'
        ], 200);
    }
}
