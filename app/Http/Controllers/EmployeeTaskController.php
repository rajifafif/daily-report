<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeTaskRequest;
use App\Http\Requests\UpdateEmployeeTaskRequest;
use App\Models\EmployeeTask;

class EmployeeTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreEmployeeTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeTaskRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeTask  $employeeTask
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeTask $employeeTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeTask  $employeeTask
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeTask $employeeTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeTaskRequest  $request
     * @param  \App\Models\EmployeeTask  $employeeTask
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeTaskRequest $request, EmployeeTask $employeeTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeTask  $employeeTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeTask $employeeTask)
    {
        //
    }
}
