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
    <div class="mt-5">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Body top</label>
                <input name="name" value="body_top" type="hidden">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="value" value="">
                {{ $settings['body_top'] }}
            </textarea>
            </div>
            <button>Submit</button>
        </form>
    </div>
    <div class="mt-5">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Body right</label>
                <input name="name" value="body_right" type="hidden">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="value" value="">
                {{ $settings['body_right'] }}
            </textarea>
            </div>
            <button>Submit</button>
        </form>
    </div>
@endsection
