@extends('layouts.app')

<?php
$title = "ChickenPoll.com | Real time polls";
$description = "Create a survey or poll now! No registration required. Real-time, instant, ad-free and simple.";
?>

@section('title', $title)
@section('title-display', "List of recent polls")
@section('description', $description)
@section('description-display', "No registration required. Real-time, instant, ad-free and simple.")

@section('head')
@include('inc.meta')
@endsection

@section('content')
<div class="table">
    <table class="table table-striped">
    <thead>
        <tr>
            <th>@sortablelink('title')</th>
            <th>@sortablelink('responses_count', 'responses')</th>
            <th>@sortablelink('created_at')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($polls as $poll)
            <tr>
                <td><a href="{{ route('polls.show', $poll->slug) }}">{{ $poll->title }}</a></td>
                <td>{{ $poll->responses_count }}</td>
                <td>{{ $poll->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>
{!! $polls->appends(\Request::except('page'))->render() !!}
@endsection