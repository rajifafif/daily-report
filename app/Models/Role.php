<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use Spatie\Permission\Contracts\Permission;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function task(){
        return $this->hasMany(Task::class, 'task_id', 'id');
    }

    public function employee(){
        return $this->hasMany(Employee::class, 'employee_id', 'id');
    }

    public function permission(){
        return $this->hasMany(Permission::class, 'permission_id', 'id');
    }
}
