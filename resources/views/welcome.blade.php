@extends('layouts.main')

@section('content')
<form id="form-poll-store" method="POST" action="{{ route('poll.store') }}">
    @csrf
    <div class="py-3 options" id="options">
        <div class="form-group">
            <label for="Title">Title</label>
            <textarea name="title" class="form-control" id="Title" rows="2" placeholder="What's your favorite song?"></textarea>
        </div>
        <div class="form-group">
            <label>Poll option</label>
            <input name="options[]" id="option" class="form-control" placeholder="Enter option" required>
        </div>
        <div class="form-group">
            <label>Poll option</label>
            <input onclick="add(this)" id="option" name="options[]" class="form-control" placeholder="Enter option">
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

@section('scripts')
<script src="js/app.js"></script>
@endsection