@extends('layouts.poll')

<?php $title = 'ChickenPoll.com | '.$poll->title; ?>
@section('title', $title)
@section('description', 'Real-time, instant, ad-free and simple')

@section('head')
<?php $description = "Vote! ".$poll->options->implode('content', ' - '); ?>
@include('inc.meta')
@endsection

@section('content')
<form action="{{ route('Responses.store') }}" method="POST" onsubmit="validateForm(event);">
@csrf()
<div class="options px-1">
    <h1 style="font-size:1.9rem;">{{ $poll->title }}</h1>
        <options class="my-5"
            :id="{{ $poll->id }}"
            :options="`{{ json_encode($poll->options()->withCount('responses')->orderBy('content')->get()) }}`"
            :setprogressbars="{{ (string)$poll->hasSetting('results_after_voting') ? 'false' : 'true' }}"
            :showbuttons="true"
            :input_type="[{{ (int)$poll->hasSetting('multiple_choice') }} == 1 ? 'checkbox' : 'radio']"
        >
        </options>
</div>

@if($poll->hasSetting('captcha'))
    @if(config('captcha.GOOGLE_RECAPTCHA_KEY'))
        <div class="g-recaptcha"
            data-sitekey="{{config('captcha.GOOGLE_RECAPTCHA_KEY')}}">
        </div>
    @endif
@endif

<div class="mt-3" id="meta">
    <p>
        <strong>Total votes:
            <span id="totalresponses">
                {{
                    $poll->responses()->groupBy('ip')
                        ->raw('COUNT(*) = 1')
                        ->count()
                }}
            </span>
        </strong>
    </p>
    <button type="submit" class="btn btn-lg btn-primary">Vote</button>
    <a href="{{ route('results.show', $poll->slug) }}" style="color:white;" class="btn btn-lg btn-primary">Show results</a>
</div>
</form>
@endsection

@section('footer')
<span><a class="report-link" target="_blank" rel="noopener noreferrer" href="{{ route('report.index', $poll->id) }}">Report it</a></span>
@endsection

@section('body-bottom')
    <script>
        function validateForm(event) {
            if ($(".options input:checked").length === 0) {
                let data = "    <div class=\"mb-1\">\n" +
                    "        <small class=\"text-danger\">You haven't selected anything.</small>\n" +
                    "    </div>";

                $("#meta").prepend(data);
                event.preventDefault();
            }
        }
    </script>
@endsection
