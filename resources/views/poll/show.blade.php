<?php 
$totalVotes= $poll->votes->count();
?>

@extends('layouts.app')

@section('title', $poll->title)
@section('description', 'Real-time, instant, ad-free and simple')

@section('content')
<form action="{{ route('answers.store') }}" method="POST">
@csrf()
<div class="options my-5 px-1">
        <options :id="{{ $poll->id }}" :options="'{{ json_encode($poll->options) }}'"></options>
</div>

@if($poll->settings()->where('value', 'captcha')->exists())
    @if(config('captcha.GOOGLE_RECAPTCHA_KEY'))
        <div class="g-recaptcha"
            data-sitekey="{{config('captcha.GOOGLE_RECAPTCHA_KEY')}}">
        </div>
    @endif
@endif

<div class="mt-3">
    <p><strong>Total votes: <span id="totalVotes">{{ $totalVotes }}</strong></span></p>
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
        </div>
        <div class="col-md-6">
            @include('bitly.url')
        </div>
    </div>
</div>

@endsection