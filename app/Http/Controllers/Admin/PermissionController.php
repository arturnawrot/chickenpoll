<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
    private $permission;

    function __construct()
    {
        $this->permission = $permission;
    }

    public function sync()
    {

    }
 /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Only DIRECT permissions
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Only DIRECT permissions
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Only DIRECT permissions
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Only DIRECT permissions
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Role $role)
    {
        //
    }

    /**
     * Only DIRECT permissions
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Role $role)
    {
        //
    }}
