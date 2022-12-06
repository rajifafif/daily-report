<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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

    public function register(Request $request){
      
        $employee = Employee::create([
            'name' => $request['name'],
            'role_id' => $request['role_id']
        ]);

        $user = user::create([
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'employee_id' => $employee->id
        ]);
        
        $token = $user->createToken('myAppToken')->plainTextToken;
       
        return response()->json([
          'user' => $user,
          'employee' => $employee,
          'token' => $token
        ]);
    }

    public function login(Request $request, User $user)
    {
            // $user = User::first();
        $credentials = $request->validate([
                'email' => 'required',  
                'password' => 'required',
            ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The Provider Credentials Are Incorrect'],
            ]);
        }

        return $user->createToken('myAppToken')->plainTextToken;

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

