<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $validate = $request->validate([
            'firstName'=>'required |string| max:50',
            'lastName'=>'required |string| max:50',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|confirmed| min:8',
            'phoneNumber'=>'required|string',
            'gender'=>'required',
        ]);
        
        $user = User::create([
            'firstName' => $validate['firstName'],
            'lastName' => $validate['lastName'],
            'email' => $validate['email'],
            'password' =>bcrypt($validate['password']),
            'phoneNumber' => $validate['phoneNumber'],
            'gender' => $validate['gender'],
        ]);

        //$token = $user->createToken('my-Device')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => "Register Success"
        ];
        return response($response,201);
    

    }

    public function login(Request $request){
        $validate = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string| min:8',
            ]);
            
            $user = User::where('email',$validate['email'])->first();

            if(!$user || !Hash::check($validate['password'], $user->password)){
                $response = [
                    'message' => 'Email or Password incorrect'
                ];
                return response($response,401);
            }else{
                //ลบ Token เก่าที่ค้างอยู่
                $user->tokens()->delete();
                //สร้าง Token ใหม่
                $token = $user->createToken($request->userAgent())->plainTextToken;
                $response = [
                'user' => $user,
                'token' => $token,
                'message' => 'Login Success'
                 ];
                return response($response,201);
            }
    }

    public function logout(Request $request){
        $request -> user()->currentAccessToken()->delete();
        $response = [
            'message' => 'Logout Success'
        ];
        return response($response,201);
    }
}