<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiUserAuthController extends Controller
{
    public function register(Request $request){

        $validate =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
        ]);

        $token = $user->createToken('appToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response,201);

    }

    public function login(Request $request){

        $validate =  $request->validate([

            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        //Check email
        $user = User::where('email',$validate['email'])->first();

        //Check User

        if(!$user || !Hash::check($validate['password'],$user->password)){
            return response([
                'message' => 'Sorry, Something wrong with your user details!'
            ],401);
        }

        $token = $user->createToken('appToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response,201);

    }


    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
