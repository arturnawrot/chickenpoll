<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php
    $title = "$post->title";
    $description = $post->description ?? $post->excerpt;
  ?>
  <title>{{ $title }}</title>
  @include('inc.meta')

  <link href="{{ asset('css/blog/clean-blog.css') }}" rel="stylesheet">


</head>

<body>

@include('inc.blog.nav')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url({{ $post->featured_image }})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>{{ $post->title }}</h1>
            <span class="subheading">{{ $post->author->name }}</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <article>
            {!! $post->body !!}
        </article>
        <!-- <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div> -->
      </div>
    </div>
  </div>

  <hr>

@include('inc.footer')

  <script src="{{ asset('js/blog/clean-blog.js') }}" defer></script>
  @include('inc.google')

</body>

</html>