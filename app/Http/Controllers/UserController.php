<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function postData(Request $request){
        $validate = $request->validate([
            'firstName'=>'required |string| max:50',
            'lastName'=>'required |string| max:50',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|confirmed| min:8',
            'phoneNumber'=>'required|string',
            'gender'=>'required',
        ]);
        //return User::create($validate->all());

        $user = User::create([
            'firstName' => $validate['firstName'],
            'lastName' => $validate['lastName'],
            'email' => $validate['email'],
            'password' =>bcrypt($validate['password']),
            'phoneNumber' => $validate['phoneNumber'],
            'gender' => $validate['gender'],
        ]);

        $token = $user->createToken('my-Device')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response);

        //return
    }

    
}
