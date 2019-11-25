<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Add new role</h4>
            <!-- <p class="card-description"> Basic form layout </p> -->
            @if(isset($role))
                <form class="forms-sample" method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                @method('PATCH')
            @else
                <form class="forms-sample" method="POST" action="{{ route('admin.roles.store') }}">
            @endif    
                        @csrf
                        <div class="form-group">
                            <label>Role name</label>
                            <input value="{{ $role->name ?? '' }}" class="form-control" name="name" placeholder="Role name">
                        </div>
                        <div class="form-group">
                            <label>Role authority</label>
                            <input value="{{ $role->authority ?? 0 }}" style="max-width:120px;" class="form-control" type="number" name="authority" min="0">
                        </div>
                        <div class="form-group">
                            <!-- <label for="permissions">Permissions</label> -->
                            @foreach($permissions as $permission)
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>{{ $permission->name }}</label>
                                        </div>
                                        <div class="col">
                                            <label class="switch">
                                                <?php $checked = ""; ?>
                                                @if(isset($role))
                                                    @if($role->hasPermissionTo($permission))
                                                        <?php $checked = 'checked="checked"'; ?>
                                                    @endif
                                                @endif
                                                <input {{ $checked }} type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">
                @if(isset($role))
                    Edit 
                @else
                    Add
                @endif
            </button>
            </form>
            </div>
        </div>
    </div>