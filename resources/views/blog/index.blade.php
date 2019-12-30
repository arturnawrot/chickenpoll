@extends('layouts.blog')

@section('content')
@foreach($posts as $post)
<div class="post-preview">
    <a href="{{ route('blog.show', $post->slug) }}">
    <h2 class="post-title">
        {{ $post->title }}
    </h2>
    <h3 class="post-subtitle">
        {!! $post->excerpt !!}
    </h3>
    </a>
    <p class="post-meta">Posted by
    <a href="{{ route('blog.show', $post->slug) }}">Start Bootstrap</a>
    on {!! $post->publish_date->formatLocalized('%d %B %Y') !!}</p>
</div>
<hr>
@endforeach
@endsection