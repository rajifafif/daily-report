<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeTask;
use App\Models\User;
use App\Models\Task;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Storage;

    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|same:confirm-password',
        //     'roles' => 'required'
        // ]);
    
        // $input = $request->all();
        // $input['password'] = Hash::make($input['password']);
    
        // $user = User::create($input);
        // $user->assignRole($request->input('roles'));
    
        // return redirect()->route('users.index')
        //                 ->with('success','User created successfully');

        
        Employee::create([
            'name' => 'required',
            'name_prefix' => 'required',
            'name_suffix' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'position_id' => 'required',
            'last_education' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'main_address_id' => 'required'
        ]);

        $validateData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $validateData['employee_id'] = Employee::latest()->get()[0]['id'];

        User::create($validateData);
    
        return redirect('/users')->with('success', 'Profil berhasil diupdate!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        // $task = Task::where('role_id', $task->role_id)->get();
        // $tasks = Task::where('id', $task->id)->get();
        // ->pluck('task.task_id', $task->task_id)
        // $task = Task::where('role_id', $task->role_id)
        //     ->pluck('task.task_id', 'task.task_id')
        //     ->all();
        // dd($tasks);
    
        return view('users.edit',compact('user','roles','userRole','task'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function profile(Employee $employee){
        return view('profile.index', [
            'title' => 'profile',
            'employee_id' => $employee
        ]);
    }

    public function updatepassword(Request $request, User $user){
        if($request["password"] != $request["password2"]){
            return redirect('/users/profile' . auth()->user()->id)->with('error', 'Password Tidak Sama!');
        }
        
        // dd($request);
        User::where('id', $user->id)->
        update(['password' => bcrypt($request["password"])]);
        return redirect('/users/profile')->with('success', 'Password Berhasil Diubah!');

    }

    public function updateprofile(Request $request, User $user, Employee $employee){
        $kwn = [
            'email' => 'required',
        ];

        $validateData = $request->validate($kwn);

        User::where('id', $user->id)
        ->update($validateData);

        $emply = [
            'name' => 'required',
            'name_prefix' => 'required',
            'name_suffix' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'position_id' => 'required',
            'last_education' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'main_address_id' => 'required'
        ];

        $validatedData = $request->validate($emply);

        Employee::where('id', $employee->id)
            ->update($validatedData);

        return redirect('/users/profile')->with('success', 'Profil berhasil diupdate!');

    }
}