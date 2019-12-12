<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface as User;
use App\Repositories\Contracts\RoleRepositoryInterface as Role;

class UserController extends Controller
{
    private $user;
    private $role;

    function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $this->authorize('viewAny');
        return view('admin.user.index', ['users' => $this->user->sortable()->paginate(50)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);
        $this->authorize('view', $user);

        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->find($id);
        $role = $this->role->findBy('name', $request->role);

        $this->authorize('update', $user);

        // @TODO Not clean
        if (Gate::denies('update-role', $role)) {
            abort(403);
        }

        $user->update($request->only('name', 'email'));
        $user->syncRoles([$role]);

        return redirect()->back()->with('alert-success', 'User was successful updated!');
    }
}
