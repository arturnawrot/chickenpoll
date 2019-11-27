@extends('layouts.admin')

@section('content')
        @include('admin.role.forms.roleCreateOrUpdate')
        <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Remove role</h4>
                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        @if($role->users->count() > 0)
                        <p>You can remove this rule and replace with:</p>
                                <div class="form-group">
                                        <label>Role</label>
                                        <select name="role" class="form-control">
                                        @foreach($roles as $role)
                                                @if($role->name == 'root')
                                                        @continue
                                                @endif
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                        </select>
                                </div>
                        @endif
                        <button type="submit" class="btn btn-gradient-danger mr-2">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection

