<?php

namespace Database\Seeders;

use App\Models\Daily;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Daily::create([
            'role_id' => '2', 
            'task_id' => '1',
        ]);

        Daily::create([
            'role_id' => '2', 
            'task_id' => '2',
        ]);

        Daily::create([
            'role_id' => '2', 
            'task_id' => '3',
        ]);

        Daily::create([
            'role_id' => '1', 
            'task_id' => '3',
        ]);
    }
}
