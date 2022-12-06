<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::orderBy('id','asc')->get();
            return response()->json([
                UserResource::collection($user)
            ]);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $employee = Employee::create([
            'name' => $request['name'],
            'role_id' => $request['role_id']
        ]);

        $user = User::create([
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'employee_id' => $employee->id,
        ]);

        $token = $user->createToken('myAppToken')->plainTextToken;
       
        $this->validate($request, [
            'task' => 'required'
        ]);

        $employee->tasks()->attach($request->input('task'));
        
        $userData = $request->toArray();

        return response()->json(UserResource::make($user));
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json(UserResource::make($user));
    }

    public function edit(Task $task, $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole','task'));
    }

    public function update(User $user, Request $request)
    {
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
        
        // dd($request->employee_id);
        $user = User::where('employee_id', $request->employee_id)->with(['employee'])->first();
        if($request->has('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        
        $this->validate($request, [
            'tasks.*.task' => 'required'
        ]);
        // dd($request->toArray());

        $user->employee->tasks()->sync($request->input('task'));

        $user->update($request->only([
            'id',
            'email',
            'password',
            'employee_id',
            // 'token',
        ]));

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

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
