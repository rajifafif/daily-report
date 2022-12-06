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
        return $this->hasMany(Role::class, 'role_id', 'id');
    }

    public function task(){
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
