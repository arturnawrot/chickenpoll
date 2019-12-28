@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <form class="forms-sample" method="POST" action="{{ route('admin.polls.update', $poll->id) }}">
                        @csrf
                        @method('PATCH')
                      <div class="form-group">
                        <label for="title">Name</label>
                        <input name="title" value="{{ $poll->title }}" class="form-control" id="name">
                      </div>
                <div class="my-4">
                <div class="row">
                        <td>ID:</td>
                        <td>{{ $poll->id }} </td>
                    </div>
                    <div class="row">
                        <td>Date of creation:</td>
                        <td>{{ $poll->created_at }} </td>
                    </div>
                    <div class="row">
                        <td>IP:</td>
                        <td>{{ $poll->ip }} </td>
                    </div>
                    <div class="row">
                        <td>Votes:</td>
                        <td>{{ $poll->votes->count() }} </td>
                    </div>
                </div>

                <p>Options</p>
                <div class="form-group">
                    @foreach($poll->options as $option)
                        <input class="mt-2 form-control" name="options[]" type="text" value="{{ $option->content }}">
                    @endforeach
                </div>

                      <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                    </form>
            </div>
            <form action="{{ route('admin.polls.destroy', $poll->id) }}" method="POST">
               @csrf()
               @method('DELETE')
               <button class="btn btn-danger">Delete poll</button>
            </form>
        </div>
    </div>
@endsection
