<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PollRepositoryInterface as Poll;
use App\Repositories\Contracts\OptionRepositoryInterface as Option;
use App\Repositories\Contracts\SettingRepositoryInterface as Setting;
use App\Http\Requests\StorePoll;

class PollController extends Controller
{
    private $poll;
    private $option;
    private $settings;

    function __construct(Poll $poll, Option $option, Setting $setting)
    {
        $this->poll = $poll;
        $this->option = $option;
        $this->setting = $setting;
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
            if($option == null) {
                continue;
            }
            $option = $this->option->instance(['content' => $option]);
            $poll->options()->save($option);
        }

        if($request->settings) {
            foreach($request->settings as $setting)
            {
                if(in_array($setting, array('captcha', 'ip_checking', 'multiple_choice'))) {
                    $setting = $this->setting->instance(['name' => $setting, 'value' => $setting]);
                    $poll->settings()->save($setting);
                }
            }
        }


        return redirect()->route('polls.show', $poll->slug);
    }

    public function show($id)
    {
        $poll = $this->poll->makeModel()
            // ->where('id', $id)
            // ->orWhere('slug', $id)
            ->where('slug', $id)
            ->firstOrFail();
        return view('poll.show', ['poll' => $poll]);
    }

    public function destroy($id)
    {

    }
}
