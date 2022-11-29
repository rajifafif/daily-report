<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function role(){
        return $this->hasMany(Role::class, 'id', 'role_id');
    }

    public function task(){
        return $this->hasMany(Task::class, 'id', 'task_id');
    }
}
