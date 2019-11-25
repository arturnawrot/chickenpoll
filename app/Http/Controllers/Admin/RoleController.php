<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepositoryInterface as Role;

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
        $role = $this->role->create($request->only('name', 'authority'));
        $role->syncPermissions($request->only('permissions'));
        return redirect()->back()->with('alert-success', 'Role has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin.role.edit', [
            'roles' => $this->role->all(),
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

        // Replace a role with another one
        $newRole = $request->role;
        $role->users()->each(function($user, $key) use ($newRole) {
            $user->syncRoles([$newRole]);
        });
        $role->delete();

        return redirect()->route('admin.roles.index')->with('alert-success', 'Role has been removed!');
    }
}
