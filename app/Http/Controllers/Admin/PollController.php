<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poll;

class PollController extends Controller
{
    private $poll;

    function __construct(Poll $poll)
    {
        $this->poll = $poll;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware(['permission:poll.view']);
        return view('admin.poll.index', ['polls' => $this->poll->withCount('responses')->sortable()->paginate(50)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware(['permission:poll.update']);
        $poll = $this->poll->find($id);
        // $this->authorize('view', $user);

        return view('admin.poll.edit', [
            'poll' => $poll
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->middleware(['permission:poll.update']);
        $poll = $this->poll->find($id);
        $pollOptions = $poll->options()->get();

        // Title
        $poll->update(['title' => $request->title]);

        // Options
        $newOptions = $request->options;
        foreach($newOptions as $key => $newOption)
        {
            // Delete if empty
            if($newOption == '') {
                $pollOptions[$key]->delete();
                continue;
            }
            $pollOptions[$key]->update([ 'content' => $newOption ]);
        }

        return redirect()->back()->with('alert-success', 'The poll has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware(['permission:poll.delete']);
        $poll = $this->poll->find($id);
        $poll->delete();

        return redirect()->route('admin.polls.index')->with('alert-success', 'Poll has been trashed!');
    }
}
