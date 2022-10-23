<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;   

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $usr = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if($usr)
        {
            return response()->json([
                'success' => true,
                'user' => $usr 
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }
}
