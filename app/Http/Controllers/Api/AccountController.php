<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    //
    public function register(Request $request)
    {

       $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $user = new User($data);
        $user->setPassword($request->password);
        $user->save();
        $plainTextToken = $user->createToken('MobileApp')->plainTextToken;
        $parts = explode('|',$plainTextToken);
        $user['token'] = $parts[1];
        return response()->json($user,200);

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();
        $userExist = $user != null && $user->passPasswordChallenge($request->password);
        if(!$userExist){
            return response()->json(['message' => 'Invalid Email Or Credentials'],403);
        }
        $plainTextToken = $user->createToken('MobileApp')->plainTextToken;
        $parts = explode('|',$plainTextToken);
        $user['token'] = $parts[1];
        return response()->json($user,200);
    }
}
