<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        try {
            $request->validate([
                'name'=>'required|string',
                'email'=>'required|string',
                'password'=>'required|string'
            ]);
            $user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> bcrypt($request->password)
            ]);
            return response()->json([
                'message'=>'user created Successfully',
                'user'=> $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error'=> $e->getMessage()
            ]);
        }
    }

    public function login(Request $request){
        try {
            $request->validate([
                'email'=>'required|string',
                'password'=>'required|string'
            ]);
            $credentials = $request->only('email','password');
            $token = Auth::attempt($credentials);
            if (!$token) {
                return response()->json([
                    'error'=>'Unauthorized'
                ],401);
            }
            return response()->json([
                'token'=>$token,
                'token_type'=>'Bearer',
                'expires_in'=> 3600
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error'=>$e->getMessage()
            ]);
        }
    }
}
