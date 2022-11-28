<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request){
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
    
    if($validate->fails()){
        $respon = [
            'status' => 'error',
            'msg' => 'Validator Error',
            'error' => $validate->errors(),
            'content' => null
        ];

        return response()->json($respon, 200);
    }else{
        $credentials = request(['username', 'password']);
        $credentials = Arr::add($credentials, 'status', 'aktif');
        if(!Auth::attempt($credentials)){
            $respon = [
                'status' => 'error',
                'msg' => 'Unathorized',
                'errors' => null,
                'content' => null
            ];

            return response()->json($respon, 401);
        }

        $role = Role::where('username', $request->username)->first();
        if(!Hash::check($request->password, $role->password, [])){
            throw new Exception('Error In Login');
        }

        $tokenResult = $role->createToken('token-auth')->plainTextToken;
        $respon = [
            'status' => 'success',
            'msg' => 'Login Successfully',
            'error' => null,
            'content' => [
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]

        ];
            return response()->json($respon, 200);
    }
    
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $respon = [
            'status' => 'error',
            'msg' => 'Logout Successfull',
            'error' => null,
            'content' => null
        ]; 

        return response()->json($respon, 200);
    }
}
