<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'employee_tasks', 'employee_id', 'task_id');
    }

    public function employee_tasks(){
        return $this->hasMany(EmployeeTask::class, 'employee_tasks', 'id');
    }

}
