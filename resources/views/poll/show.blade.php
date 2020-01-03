@extends('layouts.app')

<?php $title = 'ChickenPoll.com | '.$poll->title; ?>
@section('title', $title)
@section('title-display', $poll->title)
@section('description', 'Real-time, instant, ad-free and simple')
@section('description-display', 'Real-time, instant, ad-free and simple')

@section('head')
<?php $description = "Vote! ".$poll->options->implode('content', ' - '); ?>
@include('inc.meta')
@endsection

@section('content')
<form action="{{ route('answers.store') }}" method="POST">
@csrf()
<div class="options my-5 px-1">
        <options
            :id="{{ $poll->id }}"
            :options="`{{ json_encode($poll->options()->withCount('votes')->orderBy('votes_count', 'desc')->get()) }}`"
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
    <p><span id="totalVotes"><strong>Total votes: {{ $poll->votes->count() }}</strong></span></p>
    <button type="submit" class="btn btn-lg btn-primary">Vote</button>
</div>
</form>
<div class="mt-4">
    @include('inc.banners.2')
</div>
<div class="mt-5 share">
    <div class="row">
        <div class="col-md-6">
            @include('bitly.url')
            <div class="form-group">
                <label for="link">Link with a friendly slug</label>
                <input id="link" class="col-md-10 form-control" type="text" value="{{ url('').'/'.$poll->slug }}">
            </div>
            <!-- <div class="form-group">
                <label for="link">Link with a numeric ID</label>
                <input id="link" class="col-md-10 form-control" type="text" value="{{ url('').'/'.$poll->id }}">
            </div> -->
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
