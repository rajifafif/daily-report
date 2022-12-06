<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTask extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function employee(){
        $this->hasMany(Employee::class, 'employee_id', 'id');
    }

    public function tasks(){
        $this->hasMany(Task::class, 'task_id', 'id');
    }
}
