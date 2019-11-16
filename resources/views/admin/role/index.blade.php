@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Add new role</h4>
            <!-- <p class="card-description"> Basic form layout </p> -->
            <form class="forms-sample" method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf
            <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>Role name</label>
                            <input class="form-control" name="name" placeholder="Role name">
                        </div>
                        <div class="form-group">
                            <label>Role authority</label>
                            <input value="0" style="max-width:120px;" class="form-control" type="number" name="authority" min="0">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="form-group">
                            <label for="permissions">Double click to attach permissions for the new role</label>
                            <select style="min-height: 120px;" multiple class="form-control" id="permissionSelect">
                                @foreach($permissions as $permission)
                                    <option ondblclick="addPermission(this)" value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <p>Permissions:</p>
            <p id="permissionList">

            </p>
            <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>

            </form>

            </div>
        </div>
    </div>
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

@section('bottom')
<script>
    function addPermission(permission)
    {
        let permissionBackup = permission;

        var newInput = document.createElement("input"); 
        var newLabel = document.createElement("label"); 
        
        newInput.id = permission.value;
        newInput.value = permission.value;
        newInput.name = "permissions[]";
        newInput.type = "hidden";

        newLabel.id = permission.value;
        newLabel.innerHTML = permission.value; 
        newLabel.classList.add("badge");
        newLabel.classList.add("badge-info");
        newLabel.classList.add("mr-1");
        newLabel.onclick = function() { 
            document.getElementById('permissionSelect').appendChild(permissionBackup);

            newInput.remove();
            newLabel.remove();
        };

        var permissionList = document.getElementById('permissionList');

        permissionList.appendChild(newInput);
        permissionList.appendChild(newLabel);

        // It would be good to remove the role from the select
        permission.remove();
    }
</script>
@endsection