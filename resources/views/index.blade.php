@extends('layouts.app')

<?php
$title = "Chicken Poll - Create a poll online for free";
$description = "Make your own survey or poll in seconds! No registration required. Our polls are real-time, instant and simple.";
?>

@section('title', $title)
@section('title-display', "Create a poll")
@section('description', $description)
@section('description-display', "No registration required. Real-time, instant and simple surveys for free.")

@section('head')
@include('inc.meta')
@endsection

@section('content')

                    <form method="POST" action="{{ route('polls.store') }}">
                          <div class="py-3 options" id="options">
                              <div class="form-group">
                                  <label for="Title">Title</label>
                                  <textarea name="title" class="form-control" id="Title" rows="2" placeholder="What's your favorite song?"></textarea>
                                </div>
                              <div class="form-group">
                                  <label for="question1">Poll option</label>
                                  <input name="options[]" class="form-control" id="question1" placeholder="Enter option">
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

@section('body-bottom')
<script>
    function add(element)
    {
        let options = document.getElementById('options');
        var div = document.createElement('div');
        div.className = "form-group";

        var label = document.createElement('label');
        label.innerHTML = "Poll option";

        var input = document.createElement('input');
        input.placeholder = "Enter option";
        input.name = "options[]";
        input.className = "form-control";

        div.onclick = function () {
            div.onclick = null;
            add();
        }

        div.appendChild(label);
        div.appendChild(input);

        options.appendChild(div);

        element.onclick = null;
    }
</script>
@endsection
