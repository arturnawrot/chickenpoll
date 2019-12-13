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
                    <div class="mt-2 progress" style="padding-left:0;height: 38px;">
                        <?php
                            $optionVotes = $option->votes->count();
                            $totalVotes= $poll->votes->count();
                            $percentage = $optionVotes / $totalVotes * 100
                        ?>
                        <div class="progress-bar" role="progressbar" style="width: {{$percentage}}%;" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">
                            {{ $optionVotes }} votes
                        </div>
                    </div>
            </div>
        @endforeach
</div>


<div class="mt-3">
    <p>Total votes: {{ $totalVotes }}</p>
    <button type="submit" class="btn btn-lg btn-primary">Vote</button>
</div>
</form>
@endsection