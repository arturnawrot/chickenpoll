@extends('layouts.app')

<?php $title = 'ChickenPoll.com | '.$poll->title; ?>
@section('title', $title)
@section('title-display', "Results")
@section('description', 'Real-time, instant, ad-free and simple')

@section('head')
    <?php $description = "Vote! ".$poll->options->implode('content', ' - '); ?>
    @include('inc.meta')
@endsection

@section('content')
    <div class="poll">
        <h1 style="font-size:1.9rem;">{{ $poll->title }}</h1>
        <div class="options my-5 px-1">
                <options
                    :id="{{ $poll->id }}"
                    :options="`{{ json_encode($poll->options()->withCount('votes')->orderBy('votes_count', 'desc')->get()) }}`"
                    :setprogressbars="true"
                    :showbuttons="false"
                    :input_type="[{{ (int)$poll->settings()->where('value', 'multiple_choice')->exists() }} == 1 ? 'checkbox' : 'radio']"
                >
                </options>
            </div>

            <div class="mt-3">
                <p><strong>Total votes: <span id="totalVotes">{{ $poll->votes->count() }}</span></strong></p>
            </div>
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
                    <input id="link" class="col-md-10 form-control" type="text" value="{{ route('polls.show', $poll->slug) }}">
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
