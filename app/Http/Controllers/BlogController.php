<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Wink\WinkPost;

class BlogController extends Controller
{
    private $post;

    function __construct(WinkPost $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC')
            ->simplePaginate(12);

        return view('blog.index', [
            'posts' => $posts
        ]);
    }

    public function show($slug)
    {
        return view('blog.show', [
            'post' => $this->post->where('slug', $slug)->first()
        ]);
    }
}
