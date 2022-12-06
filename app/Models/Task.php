<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function employees(){
        return $this->belongsToMany(Employee::class, 'employee_tasks', 'employee_id', 'task_id');
    }

    public function role(){
        return $this->hasMany(Role::class, 'role_id', 'id');
    }

    public function dailyReports(){
        return $this->hasMany(DailyReport::class, 'task_id', 'id');
    }
}
