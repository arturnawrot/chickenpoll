<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Poll;

class OptionController extends Controller
{
    private $option;
    private $poll;

    function __construct(Poll $poll, Option $option)
    {
        $this->option = $option;
        $this->poll = $poll;
    }

    public function store($pollId, Request $request)
    {
        $this->middleware(['permission:option.update']);
        $poll = $this->poll->find($pollId);
        $poll->options()->save(new Option(['poll_id' => $pollId, 'content' => $request->content]));

        return redirect()->back()->with('alert-success', 'The poll has been successfully updated');
    }

    public function destroy($id)
    {
        $this->middleware(['permission:poll.delete']);
        $poll = $this->poll->find($id);
        $poll->delete();

        return redirect()->back()->with('alert-success', 'The option has been removed');
    }
}
