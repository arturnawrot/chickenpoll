@extends('layouts.admin')

@section('content')
    @include('admin.role.forms.roleCreateOrUpdate')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Roles</h4>
                <p class="card-description">
                    Users and permissions
                </p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Authority</th>
                                <th>Role</th>
                                <th>Count users</th>
                                <th>Permissions</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->authority }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->users()->count() }}</td>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                                <li>{{ $permission->name }}</li>
                                            @endforeach
                                        </td>
                                        <td><a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-fw">Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
@endsection