<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{
    private $role;

    function __construct(Role $role)
    {
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.role.index', [
            'roles' => $this->role->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $role = $this->role->instance($request->only('name', 'authority'));

        $this->authorize('create', $role);

        $role->save();
        $role->syncPermissions($request->only('permissions'));

        return redirect()->back()->with('alert-success', 'Role has been added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->middleware(['permission:role.view']);

        return view('admin.role.edit', [
            'role' => $this->role->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $role = $this->role->find($id);

        // @TODO It just looks bad :P
        $this->authorize('create', $this->role->instance($request->only('name', 'authority')));

        $role->update($request->only('name', 'authority'));
        $role->syncPermissions($request->permissions);
        return redirect()->back()->with('alert-success', 'Role has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $role = $this->role->find($id);

        $this->authorize('delete', $role);

        // Replace a role with another one
        if($role->users()->count() > 0) {
            $newRole = $this->role->findBy('name', $request->role);
            if (Gate::denies('update-role', auth()->user(), $newRole)) {
                abort(403);
            }
            $role->users()->each(function($user, $key) use ($newRole) {
                $user->syncRoles([$newRole->name]);
            });
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('alert-success', 'Role has been removed!');
    }
}
