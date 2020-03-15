@extends('layouts.app')

<?php
    $title = "$post->title";
    $description = $post->description ?? $post->excerpt;
  ?>

@section('content')
  <!-- Page Header -->
  {{--<header class="masthead" style="background-image: url({{ $post->featured_image }})">--}}
            <h1>{{ $post->title }}</h1>
            {{--<span class="subheading">{{ $post->author->name }}</span>--}}
  {{--</header>--}}

  <!-- Main Content -->

        <article>
            {!! $post->body !!}
        </article>
        <!-- <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div> -->

  <hr>
@endsection
