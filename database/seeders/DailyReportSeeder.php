<?php

namespace Database\Seeders;

use App\Models\DailyReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DailyReport::create([
            'task_id' => '1',
            'employee_id' => '1',
            'description' => 'Membuat Makanan',
            'date' => 2022-11-28,
            'total_minutes' => 1499,
        ]);
    }
}
