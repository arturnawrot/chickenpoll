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

@section('content-bottom')
    <div class="row">
        <div class="col-md-4">
            <div class="shadow mb-5 bg-white rounded mx-auto">
                <div class="card-body">
                    <div class="card-title">
                        <b>Safety first</b>
                    </div>
                    <div class="card-text">
                        Creating polls or voting is completely anonymous. We will never share any information about you with third parties.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="shadow mb-5 bg-white rounded mx-auto">
                <div class="card-body">
                    <div class="card-title">
                        <b>VPN detection</b>
                    </div>
                    <div class="card-text">
                        We effectively block any proxy or VPN traffic and prevent from voting in our polls.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="shadow mb-5 bg-white rounded mx-auto">
                <div class="card-body">
                    <div class="card-title">
                        <b>Free of charge</b>
                    </div>
                    <div class="card-text">
                        We will never charge you for using our services. Our polls and surveys are 100% free to create.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    @foreach($polls as $poll)
            @if(count($poll->responses) < 3)
                @continue
            @endif
            <div class="col-md-6">
                <div class="shadow mb-5 bg-white rounded mx-auto">
                    <div class="card-body">
                        <h5 class="card-title">{{ $poll->title }}</h5>
                        <p class="card-text">
                            <piechart
                                :labels="`{{ json_encode($poll->options()->pluck('content')->toArray()) }}`"
                                :scores="`{{ json_encode($poll->options()->withCount('responses')->pluck('responses_count')->toArray()) }}`"
                            ></piechart>
                        </p>
                        <a href="{{ route('polls.show', $poll->slug) }}" class="btn btn-primary">Check it out</a>
                    </div>
                </div>
            </div>
    @endforeach
    </div>
{{--    {{ $polls->links() }}--}}

    <div class="row mt-3">
        @include('inc.posts')
    </div>
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
