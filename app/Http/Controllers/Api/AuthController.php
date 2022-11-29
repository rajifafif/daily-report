<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{    
    /**
     * login
     * Login using email & password
     *
     * @param  string $request['email']
     * @param  string $request['password']
     * @return UserResource $user
     */
    public function login(Request $request)
    {
        
        $user = User::first();

        return UserResource::make($user);
    }
    
    /**
     * logout
     * Delete currently used token
     *
     * @return boolean
     */
    public function logout(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }
}
