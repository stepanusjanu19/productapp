<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $credetial = $request->only('email', 'password');

        if(!$token = auth()->guard('api')->attempt($credetial))
        {
            return response()->json([
                'success' =>  false,
                'message' => 'Email atau Password anda Salah'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user' => auth()->guard('api')->user(),
            'token' => $token
        ], 299);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }

}
