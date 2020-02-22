<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shortlink;
use Bitly;
use App\Models\Poll;

class ShortlinkController extends Controller
{
    private $shortlink;

    function __construct(Shortlink $shortlink)
    {
        $this->shortlink = $shortlink;
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        if(!$this->shortlink->exists('url', $request->url)) {
            $shortened_url = Bitly::getUrl($request->url);
            $this->shortlink->create([
                'url' => $request->url,
                'shortened_url' => $shortened_url,
                'service' => 'bitly',
                'ip' => $_SERVER['REMOTE_ADDR']
            ]);
        } else {
            $shortened_url = $this->shortlink
                ->where('url', $request->url)
                ->firstOrFail()
                ->shortened_url;
        }

        return $shortened_url;
    }
}
