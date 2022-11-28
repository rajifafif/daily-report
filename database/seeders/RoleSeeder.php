<?php

namespace Database\Seeders;

use Directory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Employee',
            'Director',
            'Commisioner',
            'Dev',
            'Project Manager'
        ];

        // Role::truncate();

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
