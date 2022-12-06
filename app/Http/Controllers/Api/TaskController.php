<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\DailyReport;
use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:task-list|task-create|task-edit|task-delete', ['only' => ['index','show']]);
         $this->middleware('permission:task-create', ['only' => ['create','store']]);
         $this->middleware('permission:task-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:task-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $task = Task::orderBy('id','asc')->get();
            return response()->json([
                TaskResource::collection($task)
            ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create([
            'parent_id' => $request['parent_id'],
            'name' => $request['name'],
            'description' => $request['description'],
            'est_hours' => $request['est_hours']
        ]);

        $daily = DailyReport::create([
            'task_id' => $task->id,
            'employee_id' => $request['employee_id'],
            'description' => $task->description,
            'date' => $request['date'],
            'start' => $request['start'],
            'end' => $request['end'],
            'total_minutes' => $request['total_minutes'],
            'blocker' => $request['blocker'],
            'todo' => $request['todo']
        ]);
        
        $userData = $request->toArray();

        return response()->json(TaskResource::make($task));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Task::find($id);

        return response()->json(TaskResource::make($user));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // dd($request->toArray());
        $this->validate($request, [
            'parent_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'est_hours' => 'required',
            
            'daily_reports.*.task_id' => 'required',
            'daily_reports.*.employee_id' => 'required',
            'daily_reports.*.description' => 'required',
            'daily_reports.*.date' => 'required',
            'daily_reports.*.start' => 'required',
            'daily_reports.*.end' => 'required',
            'daily_reports.*.total_minutes' => 'required',
            'daily_reports.*.blocker' => 'required',
            'daily_reports.*.todo' => 'required'
        ]);
        
        $userData = $request->toArray();
        
        $task = Task::where('id', $request->id)->first();
    
        return response()->json(TaskResource::make($task));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
    
        return redirect()->route('task.index')
                        ->with('success','task deleted successfully');
    }

    public function assignTasks(Request $request, Employee $employee){
        $request->validate([
            // 'employee_id' => 'required',
            'task_ids' => 'required'
        ]);

        $task = $request->toArray();

        // $employee = Employee::where('id', $request->employee_id)->first();
        $employee->tasks()->sync($request->input('task_ids'));

        return response(TaskResource::collection($employee->tasks));
    }
}
