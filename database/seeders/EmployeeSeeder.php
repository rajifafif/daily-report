<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'owner_user_id' => '1',
            'nik' => 12345,
            'name_prefix' => 'Fadila',
            'name' => 'Fadila Akbar',
            'name_suffix' => 'Akbar',
            'phone' => '08123921083',
            'email' => 'fadilakbar79@gmail.com',
            'gender' => 'Male',
            'birth_date' => '16-09-2000',
            'birth_place' => 'Tangerang',
            'position_id' => 'Commisioner',
            'last_education' => 'S3',
            'religion' => 'Islam',
            'marital_status' => 'Belum Menikah',
            'main_address_id' => 'Jl. Jalan'
        ]);
    }
}
