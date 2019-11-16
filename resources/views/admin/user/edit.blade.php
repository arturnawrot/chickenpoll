@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4>{{ $user->name }}</h4>
                <div class="my-4">
                    <th>
                        <td>Date of registration:</td>
                        <td>{{ $user->created_at }} </td>
                    </th>
                </div>

                    <form class="forms-sample">
                        <div class="form-group">
                            <img class="profile-image" src="/images/avatar.png" alt="image">
                        </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input value="{{ $user->email }}" type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                      </div>
                      <!-- <div class="form-group">

                        <label>File upload</label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div> -->

                      <div class="form-group">
                        <label for="exampleSelectGender">Role</label>
                        <select class="form-control" id="exampleSelectGender">
                            @foreach($user->getRoleNames() as $role)
                                <option>{{ $role,',' }}</option>
                            @endforeach
                        </select>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    </form>

                                


            </div>
        </div>
    </div>
@endsection
