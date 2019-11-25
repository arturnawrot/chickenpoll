<?php

namespace App\Http\View\Composers\Admin;

use App\Repositories\Contracts\RoleRepositoryInterface as Role;
use Illuminate\View\View;

class RoleComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $roles;

    /**
     * Create a new profile composer.
     *
     * @param  PermissionRepositoryInterface  $permissions
     * @return void
     */
    public function __construct(Role $roles)
    {
        // Dependencies automatically resolved by service container...
        $this->roles = $roles;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('roles', $this->roles->all());
    }
}