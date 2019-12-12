<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PollRepositoryInterface as Poll;
use App\Repositories\Contracts\OptionRepositoryInterface as Option;

class PollController extends Controller
{
    private $poll;
    private $option;

    function __construct(Poll $poll, Option $option)
    {
        $this->poll = $poll;
        $this->option = $option;
    }

    public function store(Request $request)
    {
        $poll = $this->poll->create([
            'title'     => $request->title,
            'ip'        => $_SERVER['REMOTE_ADDR'],
            'os'        => 'os',
            'browser'   => 'browser'
        ]);

        foreach($request->options as $option)
        {
            $option = $this->option->instance(['content' => $option]);
            $poll->options()->save($option);
        }

        return view('poll.show', ['poll' => $poll]);
    }

    public function show($id)
    {
        $poll = $this->poll->find($id);
        return view('poll.show', ['poll' => $poll]);
    }

    public function destroy($id)
    {

    }
}
