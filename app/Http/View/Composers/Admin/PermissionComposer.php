<?php

namespace App\Http\View\Composers\Admin;

use App\Repositories\Contracts\PermissionRepositoryInterface as Permission;
use Illuminate\View\View;

class PermissionComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $permissions;

    /**
     * Create a new profile composer.
     *
     * @param  PermissionRepositoryInterface  $permissions
     * @return void
     */
    public function __construct(Permission $permissions)
    {
        // Dependencies automatically resolved by service container...
        $this->permissions = $permissions;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('permissions', $this->permissions->all());
    }
}