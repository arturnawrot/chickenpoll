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

        $permissions['admin-dashboard'] = Permission::create(['name' => 'admin-dashboard']);

        $permissions['permissions.index'] = Permission::create(['name' => 'permission.view']);

        $permissions['role.view'] = Permission::create(['name' => 'role.view']);
        $permissions['role.create'] = Permission::create(['name' => 'role.create']);
        $permissions['role.update'] = Permission::create(['name' => 'role.update']);
        $permissions['role.delete'] = Permission::create(['name' => 'role.delete']);

        $permissions['user.view'] = Permission::create(['name' => 'user.view']);
        $permissions['user.create'] = Permission::create(['name' => 'user.create']);
        $permissions['user.update'] = Permission::create(['name' => 'user.update']);
        $permissions['user.delete'] = Permission::create(['name' => 'user.delete']);

        $permissions['profile.view'] = Permission::create(['name' => 'profile.view']);
        $permissions['profile.update'] = Permission::create(['name' => 'profile.update']);

        $permissions['poll.view'] = Permission::create(['name' => 'poll.view']);
        $permissions['poll.update'] = Permission::create(['name' => 'poll.update']);
        $permissions['poll.delete'] = Permission::create(['name' => 'poll.delete']);

        $permissions['telescope'] = Permission::create(['name' => 'telescope']);


        $roles['root']->syncPermissions($permissions);

        $users['root'] = User::Create([
            'name' => 'root',
            'email' => 'root@root.com',
            'password' => bcrypt('1234511')
        ]);

        $users['root']->assignRole($roles['root']);

        // factory(App\Models\User::class, 10)->create()->each(function ($user) {
        //     $user->assignRole('user');
        // });;
    }
}
