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
        @foreach($poll->options as $option)
            <div class="option mt-4">
                    <div class="form-check">
                        <input name="option_id" class="form-check-input" type="radio" value="{{ $option->id }}" id="{{ $option->id }}">
                        <label class="form-check-label" for="{{ $option->id }}">
                            {{ $option->content }}
                        </label>
                    </div>
                    <div class="mt-2 progress" style="padding-left:0;height: 43px;">
                        <?php
                            $optionVotes = $option->votes->count();
                            $percentage = 0;
                            if($totalVotes != 0) {
                                $percentage = $optionVotes / $totalVotes * 100;
                            }
                        ?>
                        <progressbar percentage="{{$percentage}}" votes="{{ $optionVotes }}"></progressbar>
                    </div>
            </div>
        @endforeach
</div>

@if(config('captcha.GOOGLE_RECAPTCHA_KEY'))
     <div class="g-recaptcha"
          data-sitekey="{{config('captcha.GOOGLE_RECAPTCHA_KEY')}}">
     </div>
@endif

<div class="mt-3">
    <p>Total votes: {{ $totalVotes }}</p>
    <button type="submit" class="btn btn-lg btn-primary">Vote</button>
</div>
</form>

<div class="mt-5">
    <div class="row">
        <div class="col-md-6">
            @include('bitly.url')
        </div>
        <div class="col-md-6">
            @include('inc.social-icons')
        </div>
    </div>
</div>

@endsection