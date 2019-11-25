@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Striped Table</h4>
                <p class="card-description"> Add class <code>.table-striped</code>
                </p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th> User </th>
                        <th> First name </th>
                        <th> Email </th>
                        <th> Roles </th>
                        <th> Registered at </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="py-1">
                                    <img src="/images/avatar.png" alt="image">
                                </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
                                <td>
                                    @foreach($user->getRoleNames() as $role)
                                        {{ $role,',' }}
                                    @endforeach
                                </td>
                                <td> {{ $user->created_at }} </td>
                                <td><a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-fw">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
