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
                        <th>@sortablelink('name')</th>
                        <th>@sortablelink('email')</th>
                        <th>role</th>
                        <th>@sortablelink('created_at')</th>
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
                                    {{ $user->highestRole()->name }}
                                </td>
                                <td> {{ $user->created_at }} </td>
                                <td><a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-fw">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $users->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@endsection
