@extends('layouts.app')
<?php
$title = "Recent posts";
$description = "Tutorials, tips, announcments and more";
?>

@section('title', $title)
@section('title-display', $title)
@section('description', $description)
@section('description-display', $description)

@section('head')
@include('inc.meta')
@endsection

@section('content')
@foreach($posts as $post)
<div class="mt-5 post-preview">
    <a href="{{ route('blog.show', $post->slug) }}">
    <h2 class="post-title">
        {{ $post->title }}
    </h2>
    <h3 class="post-subtitle">
        {!! $post->excerpt !!}
    </h3>
    </a>
    <p class="post-meta">Posted by
    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->author->name }}</a>
    on {!! $post->publish_date->formatLocalized('%d %B %Y') !!}</p>
</div>
<hr>
@endforeach
@endsection