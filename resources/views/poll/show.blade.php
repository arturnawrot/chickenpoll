@extends('layouts.app')

@section('title', $poll->title)
@section('description', 'Real-time, instant, ad-free and simple')

@section('content')
<form action="{{ route('answers.store') }}" method="POST">
@csrf()
<div class="options my-5 px-1">
        <options
            :id="{{ $poll->id }}"
            :options="'{{ json_encode($poll->options) }}'"
            :input_type="[{{ (int)$poll->settings()->where('value', 'multiple_choice')->exists() }} == 1 ? 'checkbox' : 'radio']"
        >
        </options>
</div>

@if($poll->settings()->where('value', 'captcha')->exists())
    @if(config('captcha.GOOGLE_RECAPTCHA_KEY'))
        <div class="g-recaptcha"
            data-sitekey="{{config('captcha.GOOGLE_RECAPTCHA_KEY')}}">
        </div>
    @endif
@endif

<div class="mt-3">
    <p><strong>Total votes: <span id="totalVotes">{{ $poll->votes->count() }}</strong></span></p>
    <button type="submit" class="btn btn-lg btn-primary">Vote</button>
</div>
</form>

<div class="mt-5 share">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="link">Link to copy</label>
                <input id="link" class="col-md-10 form-control" type="text" value="{{ url()->full() }}">
            </div>
            @include('bitly.url')
        </div>
        <div class="row mt-3">
            <div class="col">
                @include('inc.social-icons')
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<span><a class="report-link" target="_blank" rel="noopener noreferrer" href="{{ route('report.index', $poll->id) }}">Report it</a></span>
@endsection