<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
// use Spatie\Permission\Models\role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Role::create([
        //     'nip' => '111',
        //     'username' => 'employee',
        //     'password' => bcrypt('employee'),
        //     'role' => 'Employee'
        // ]);

        // Role::create([
        //     'nip' => '222',
        //     'username' => 'director',
        //     'password' => bcrypt('director'),
        //     'role' => 'Director'
        // ]);

        // Role::create([
        //     'nip' => '333',
        //     'username' => 'commisioner',
        //     'password' => bcrypt('commisioner'),
        //     'role' => 'Commisioner'
        // ]);

        // Role::create([
        //     'nip' => '444',
        //     'username' => 'dev',
        //     'password' => bcrypt('dev'),
        //     'role' => 'Dev'
        // ]);

        // Role::create([
        //     'nip' => '555',
        //     'username' => 'projectmanager',
        //     'password' => bcrypt('projectmanager'),
        //     'role' => 'Project Manager'
        // ]);

        // User::create([
        //     'nip' => '111',
        //     'name' => 'fadil',
        //     'email' => 'fadilakbar79@gmail.com',
        //     'status' => 'aktif'
        // ]);

        $this->call(RoleSeeder::class); 

        // $this->call(UserSeeder::class);
    
        $this->call(PermissionTableSeeder::class);
        
        $this->call(CreateAdminUserSeeder::class);

        $this->call(TaskSeeder::class);

        $this->call(DailySeeder::class);
     }
}
