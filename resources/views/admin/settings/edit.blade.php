@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlTextarea1">HEAD section</label>
            <input name="name" value="head" type="hidden">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="value" value="">
                {{ $settings['head'] }}
            </textarea>
        </div>
        <button>Submit</button>
    </form>
@endsection
