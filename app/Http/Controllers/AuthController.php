<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token'  => $token,
            'user'   => ['id'=>$user->id,'name'=>$user->name,'email'=>$user->email],
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json(['status'=>'error','message'=>'Invalid credentials'], 401);
        }

        $token = $request->user()->createToken('api')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token'  => $token,
            'user'   => ['id'=>$request->user()->id,'name'=>$request->user()->name,'email'=>$request->user()->email],
        ]);
    }

    public function logout()
    {
        $requestUser = auth()->user();
        if ($requestUser) {
            $requestUser->currentAccessToken()?->delete();
        }
        return response()->json(['status'=>'success','message'=>'Logged out']);
    }
}
