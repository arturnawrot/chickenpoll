@extends('layouts.poll')

<?php $title = 'ChickenPoll.com | '.$poll->title; ?>
@section('title', $title)
@section('title-display', "Results")
@section('description', 'Real-time, instant, ad-free and simple')

@section('head')
    <?php $description = "Vote! ".$poll->options->implode('content', ' - '); ?>
    @include('inc.meta')
@endsection

@section('content')
        <h1 style="font-size:1.9rem;">{{ $poll->title }}</h1>
        <div class="options my-5 px-1">
                <options
                    :id="{{ $poll->id }}"
                    :options="`{{ json_encode($poll->options()->withCount('responses')->orderBy('responses_count', 'desc')->get()) }}`"
                    :setprogressbars="true"
                    :showbuttons="false"
                    :input_type="[{{ (int)$poll->settings()->where('value', 'multiple_choice')->exists() }} == 1 ? 'checkbox' : 'radio']"
                >
                </options>
            </div>

            <div class="mt-3">
                <p>
                    <strong>Total votes:
                        <span id="totalresponses">
                            {{
                                $poll->responses()
                                    ->distinct('ip')
                                    ->count('ip')
                            }}
                        </span>
                    </strong>
                </p>
            </div>
            <div class="mt-3">
                <a href="{{ route('polls.show', $poll->slug) }}" style="color:white;" class="btn btn-lg btn-primary">Vote</a>
            </div>
@endsection

@section('footer')
    <span><a class="report-link" target="_blank" rel="noopener noreferrer" href="{{ route('report.index', $poll->id) }}">Report it</a></span>
@endsection
