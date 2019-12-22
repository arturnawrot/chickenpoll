<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Permission;

class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize all permissions';

    private $permission;

    private $permissions = [
        'admin-dashboard',
        'permissions.index',
        'role.view', 'role.create', 'role.update', 'role.delete',
        'user.view', 'user.create', 'user.update', 'user.delete',
        'profile.view', 'profile.update',
        'poll.view', 'poll.update', 'poll.delete',
        'report.view', 'report.show', 'report.delete',
        'visitor.view',
        'telescope',
        'option.update'
    ];
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Permission $permission)
    {
        parent::__construct();
        $this->permission = $permission;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach($this->permissions as $permission)
        {
            $this->permission->updateOrCreate(['name' => $permission]);
        }
    }
}
