<?php

namespace Database\Seeders;

use App\Models\EmployeeTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeTask::create([
            'employee_id' => '1',
            'task_id' => '1'
        ]);
    }
}
