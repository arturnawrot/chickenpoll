<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Answer;
use App\Events\Vote;

class AnswerController extends Controller
{
    private $option;
    private $answer;

    function __construct(Option $option, Answer $answer)
    {
        $this->option = $option;
        $this->answer = $answer;
    }

    public function store(Request $request)
    {
        $this->middleware(['permission:answer.update']);

        $id = $request->id;
        $option = $this->option->findOrFail($id);
        $new_votes = $request->new_votes;
        $extra_votes = $new_votes;
        if($extra_votes >! 0) {
            return redirect()->back()->with('alert-danger', 'Incorrect number!');
        }
        foreach(range(1, $extra_votes) as $vote)
        {
            $answer = $this->answer->create([
                'option_id' => $option->id,
                'ip' => 'fake',
                'agent' => 'fake'
            ]);

//            broadcast(new Vote($option));
        }

        return redirect()->back()->with('alert-success', 'Extra votes added!');
    }
}
