<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Option;
use App\Models\Setting;
use App\Http\Requests\StorePoll;
use App\Jobs\GenerateThumbnail;

class PollController extends Controller
{
    private $poll;
    private $option;

    function __construct(Poll $poll, Option $option)
    {
        $this->poll = $poll;
        $this->option = $option;
    }

    public function store(StorePoll $request)
    {
        $validated = $request->validated();

        $poll = $this->poll->create([
            'title'     => $request->title,
            'ip'        => $_SERVER['REMOTE_ADDR'],
            'agent'     => $_SERVER['HTTP_USER_AGENT']
        ]);

        foreach($request->options as $option)
        {
            if(is_string($option)) {
                $poll->options()->save(
                    new Option(['content' => $option])
                );
            }
        }

        if($request->settings) {
            foreach($request->settings as $setting)
            {
                if(in_array($setting, array('captcha', 'ip_checking', 'multiple_choice', 'results_after_voting'))) {
                    $poll->settings()->save(
                        new Setting(['name' => $setting, 'value' => $setting])
                    );
                }
            }
        }

        return redirect()->route('polls.show', $poll->slug);
    }

    public function show($id)
    {
        $poll = $this->poll
            ->where('slug', $id)
            ->firstOrFail();
        return view('poll.show', ['poll' => $poll]);
    }

    public function showResults($slug)
    {
        $poll = $this->poll
            ->where('slug', $slug)
            ->firstOrFail();

        return view('result.show', ['poll' => $poll]);
    }

    public function destroy($id)
    {
        // @TODO
    }
}
