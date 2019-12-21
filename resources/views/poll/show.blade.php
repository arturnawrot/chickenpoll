@extends('layouts.app')

<?php $title = 'ChickenPoll.com | '.$poll->title; ?>
@section('title', $title)
@section('title-display', $poll->title)
@section('description', 'Real-time, instant, ad-free and simple')

@section('head')
<?php $options = $poll->options->implode('content', ' - '); ?>
<meta property="og:title" content="{{ $poll->title }}"/>
<meta property="og:site_name" content="Chicken Poll" />
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:description" content="Vote! {{ $options }}" />
<meta property="og:image" content="{{ asset('images/web.png') }}" />
<meta name="title" content="{{ $poll->title }}" />
<meta name="type" content="website" />
<meta name="url" content="{{ url()->full() }}" />
<meta name="description" content="Vote! {{ $options }}" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@PollChicken" />
<meta name="twitter:creator" content="@PollChicken" />
<meta name="twitter:title" content="{{ $poll->title }}" />
<meta name="twitter:description" content="Vote! {{ $options }}" />
<meta name="twitter:image" content="{{ asset('images/web.png') }}" />
@endsection

@section('content')
<form action="{{ route('answers.store') }}" method="POST">
@csrf()
<div class="options my-5 px-1">
        <options
            :id="{{ $poll->id }}"
            :options="`{{ json_encode($poll->options) }}`"
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
            @include('bitly.url')
            <div class="form-group">
                <label for="link">Link with a friendly slug</label>
                <input id="link" class="col-md-10 form-control" type="text" value="{{ url('').'/'.$poll->slug }}">
            </div>
            <div class="form-group">
                <label for="link">Link with a numeric ID</label>
                <input id="link" class="col-md-10 form-control" type="text" value="{{ url()->full() }}">
            </div>
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