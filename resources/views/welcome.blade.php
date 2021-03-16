@extends('layouts.main')

@section('content')
<form method="POST" action="">
            <div class="py-3 options" id="options">
                <div class="form-group">
                    <label for="Title">Title</label>
                    <textarea name="title" class="form-control" id="Title" rows="2" placeholder="What's your favorite song?"></textarea>
                </div>
                <div class="form-group">
                    <label for="question1">Poll option</label>
                    <input name="options[]" class="form-control" id="question1" placeholder="Enter option" required>
                </div>
                <div class="form-group">
                    <label for="question1">Poll option</label>
                    <input onclick="add(this)" name="options[]" class="form-control" id="question1" placeholder="Enter option">
                </div>
            </div>
            <div class="checkboxes ml-1">
                @include('inc.checkboxes')
            </div>
            <div class="d-inline-block mt-4">
                <button type="submit" class="btn btn-lg btn-primary">Create</button>
            </div>
        </form>
@endsection