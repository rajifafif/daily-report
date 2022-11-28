<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'task_kode' => '111',
            'subject' => 'nyapu',
            'detail' => 'Bersih Lantai',
            'status' => 0
        ]);

        Task::create([
            'task_kode' => '222',
            'subject' => 'nyuci',
            'detail' => 'Bersih Pakaian',
            'status' => 0
        ]);

        Task::create([
            'task_kode' => '333',
            'subject' => 'masak',
            'detail' => 'Membuat Makanan',
            'status' => 0
        ]);
    }
}
