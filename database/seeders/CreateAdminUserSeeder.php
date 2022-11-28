<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          //Admin Seeder
        $user = User::create([
            'name' => 'LaravelTuts', 
            'email' => 'admin@laraveltuts.com',
            'password' => bcrypt('password'),
            // 'role' => ''
        ]);

        $user = User::create([
            'name' => 'Fadila Akbar', 
            'email' => 'fadilakbar79@gmail.com',
            'password' => bcrypt('fadil123'),
            // 'role' => ''
        ]);
      
        $role = Role::create(['name' => 'Admin']);
       
        $permissions = Permission::pluck('id','id')->all();
     
        $role->syncPermissions($permissions);   
       
        $user->assignRole([$role->id]);
    }
}
