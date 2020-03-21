@foreach($posts as $post)
    @if(in_array($post->slug, array('terms-of-use', 'privacy-policy', 'contact')))
        @continue
    @endif
    <div class="shadow mb-5 bg-white rounded row mx-auto">
        <div class="col-md-12">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->excerpt }}</p>
                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Read more</a>
            </div>
        </div>
    </div>
@endforeach
