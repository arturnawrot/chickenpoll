<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Watson\Sitemap\Facades\Sitemap;
use App\Models\Poll;

class SitemapController extends Controller
{
    private $poll;
    private $limit = 10000;

    function __construct (Poll $poll)
    {
        $this->poll = $poll;
    }

    public function index()
    {
        $polls = $this->poll->get();
        $count = $polls->count();
        $perPage = ceil($count / $this->limit);

        foreach(range(1, $perPage) as $sitemap)
        {
            Sitemap::addSitemap(route('sitemaps.polls', $sitemap));
        }

        return Sitemap::index();
    }

    public function show($id)
    {
        if($id == 0) { $id = 1; }
        $take = $this->limit;
        $polls = $this->poll->skip($this->limit * ($id - 1))->take($take)->get();

        foreach($polls as $poll)
        {
            Sitemap::addTag(route('polls.show', $poll->id), $poll->updated_at, 'daily', '1');
        }

        return Sitemap::render();
    }
}
