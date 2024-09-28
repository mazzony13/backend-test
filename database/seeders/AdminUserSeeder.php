<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    //this seeder to run admin user seeder and create roles for application

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin_role = Role::firstOrCreate([     ///Create Super admin role
            'name' => 'super-admin',
        ]);

        $user_role = Role::firstOrCreate([  ///Create normal user Role
            'name' => 'user',
        ]);

        //Create Super admin account
        $super_admin = User::firstOrCreate([
            'email' => 'admin@backend-test.com',
            'name' => 'CMS Administrator',
            'password' => 'secret',
            'username'=>'admin',
            'is_active'=>1,
            'type_id'=>null,
        ]);

        //sync super admin role with admin
        $super_admin->syncRoles('super-admin');


    }
}
