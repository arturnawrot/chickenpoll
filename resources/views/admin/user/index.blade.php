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
                        <th> Progress </th>
                        <th> Amount </th>
                        <th> Registered at </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="py-1">
                                    <img src="/images/avatar.png" alt="image">
                                </td>
                                <td> {{ $user->name }} </td>
                                <td>
                                    @foreach($user->getRoleNames() as $role)
                                        {{ $role,',' }}
                                    @endforeach
                                </td>
                                <td> $ 77.99 </td>
                                <td> {{ $user->created_at }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
