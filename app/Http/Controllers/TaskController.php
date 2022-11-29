<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
        // $task = Task::latest()->paginate(5);
        // return view('task.index',compact('tasks'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
    
        $tasks = Task::latest()->paginate(5);
        return view('task.index', [
            'tasks' => $tasks
        ])->with('i', (request()->input('page', 1) -1) * 5 );
    
    }

    public function close($id, Task $task, Request $request){
        $task = Task::where('id', $id)
        ->get()[0];
        
        Task::where('id', $task->id)
        ->update([
            'status' => 1
        ]);

        return redirect('/task/index')->with('success', '');
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'parent_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'est_hours' => 'required'
        ]);
    
        Task::create($request->all());
    
        return redirect()->route('task.index')
                        ->with('success','task created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('task.show',compact('task'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('task.edit',compact('task'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, task $task)
    {
         request()->validate([
            'parent_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'est_hours' => 'required'
        ]);
    
        $task->update($request->all());
    
        return redirect()->route('task.index')
                        ->with('success','task updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
        $task->delete();
    
        return redirect()->route('task.index')
                        ->with('success','task deleted successfully');
    }
}   