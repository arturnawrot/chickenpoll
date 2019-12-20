@extends('layouts.app')

<?php
$title = "ChickenPoll.com | Real time polls";
$description = "No registration required. Real-time, instant, ad-free and simple";
?>

@section('title', $title)
@section('description', 'Real-time, instant, ad-free and simple')

@section('head')
<meta property="og:title" content="{{ $title }}"/>
<meta property="og:site_name" content="{{ $description }}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:description" content="{{ $description }}" />
<meta property="og:image" content="{{ asset('images/web.png') }}" />
<meta name="title" content="{{ $title }}" />
<meta name="type" content="website" />
<meta name="url" content="{{ url()->full() }}" />
<meta name="description" content="{{ $description }}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@PollChicken" />
<meta name="twitter:creator" content="@PollChicken" />
<meta name="twitter:title" content="{{ $title }}" />
<meta name="twitter:description" content="{{ $description }}" />
<meta name="twitter:image" content="{{ asset('images/web.png') }}" />
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
                              <!-- <button type="button" class="ml-3 btn btn-lg btn-primary">Save draft</button> -->
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