<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            "role.view",
            "role.create",
            "role.edit",
            "role.delete",
            "role.show",
            "role.index",
            "user.view",
            "user.create",
            "user.edit",
            "user.delete",
            "user.show",
        ];

        foreach ($permissions as $value) {
            Permission::firstOrCreate([
                'name' => $value,
                'guard_name' => 'web',
            ]);
        }

      
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

       
        $adminRole->givePermissionTo(Permission::all());

   
        $admin = User::firstOrCreate(
            ['email' => 'developer@gmail.com'], 
            [
                'name' => 'Developer',
                'password' => Hash::make(value: 'S3cr3TP@ss'), 
            ]
        );

 
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }
    }
}
