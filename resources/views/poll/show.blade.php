@extends('layouts.app')

<?php $title = 'ChickenPoll.com | '.$poll->title; ?>
@section('title', $title)
@section('description', 'Real-time, instant, ad-free and simple')

@section('head')
<?php $description = "Vote! ".$poll->options->implode('content', ' - '); ?>
@include('inc.meta')
@endsection

@section('content')
    <div class="shadow mb-5 bg-white rounded poll">

<form action="{{ route('answers.store') }}" method="POST">
@csrf()
<div class="options px-1">
    <h1 style="font-size:1.9rem;">{{ $poll->title }}</h1>
        <options class="my-5"
            :id="{{ $poll->id }}"
            :options="`{{ json_encode($poll->options()->withCount('votes')->orderBy('content')->get()) }}`"
            :setprogressbars="{{ (string)$poll->hasSetting('results_after_voting') ? 'false' : 'true' }}"
            :showbuttons="true"
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
    <p><strong>Total votes: <span id="totalVotes">{{ $poll->votes->count() }}</span></strong></p>
    <button type="submit" class="btn btn-lg btn-primary">Vote</button>
    @if($poll->hasSetting('results_after_voting'))
        <a href="{{ route('results.show', $poll->slug) }}" style="color:white;" class="btn btn-lg btn-primary">Show results</a>
    @endif
</div>
</form>
    </div>

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
