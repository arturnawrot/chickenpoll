<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles['root'] = Role::create(['name' => 'root', 'authority' => 10]);
        $roles['admin'] = Role::create(['name' => 'admin']);
        $roles['user'] = Role::create(['name' => 'user']);

        Artisan::call('command:permissions');

        $permissions = Permission::All();

        $roles['root']->syncPermissions($permissions);

        $users['root'] = User::Create([
            'name' => 'root',
            'email' => 'artur.programista2@gmail.com',
            'password' => bcrypt('Zxc1234511!')
        ]);

        $users['root']->assignRole($roles['root']);
    }
}
