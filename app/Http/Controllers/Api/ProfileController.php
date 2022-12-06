<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator as ValidationValidator;

class ProfileController extends Controller
{
    public function index(Employee $employee)
    {
        // return view('profile.index', [
        //     'title' => 'profile',
        //     'employee_id' => $employee
        // ]);
        $user = auth()->user();

        return response()->json(UserResource::make($user));
    }

    // public function updatepassword(Request $request, User $user){
    //     if($request["password"] != $request["password2"]){
    //         return redirect('/users/profile' . auth()->user()->id)->with('error', 'Password Tidak Sama!');
    //     }
        
    //     // dd($request);
    //     User::where('id', $user->id)->
    //     update(['password' => bcrypt($request["password"])]);
    //     return redirect('/users/profile')->with('success', 'Password Berhasil Diubah!');

    // }

    public function updateprofile(Request $request){
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',

            'nik' => 'required',
            'name' => 'required',
            'name_prefix' => 'required',
            'name_suffix' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'role_id' => 'required',
            'last_education' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'main_address_id' => 'required'
        ]);
        
        $userData = $request->toArray();
        $user = Auth::user();
        if ($request->has('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        // dd($request->password);

        // $user->update($request->only([
        //     'id',
        //     'email',
        //     'password',
        //     'employee_id',
        //     'token',
        // ]));

        $user->employee->update($request->only([
            'name',
            'name_prefix',
            'name_suffix',
            'nik',
            'phone',
            'email',
            'gender',
            'birth_date',
            'birth_place',
            'role_id',
            'last_education',
            'religion',
            'marital_status',
            'main_address_id',
        ]));

        return response()->json(UserResource::make($user));

    }

    public function update(Request $request)
    {
        return UserRequest::make($user);
    }
}
