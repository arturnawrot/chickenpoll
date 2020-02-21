<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Response;
use App\Events\Vote;

class ResponseController extends Controller
{
    private $option;
    private $Response;

    function __construct(Option $option, Response $Response)
    {
        $this->option = $option;
        $this->Response = $Response;
    }

    public function store(Request $request)
    {
        $this->middleware(['permission:Response.update']);

        $id = $request->id;
        $option = $this->option->findOrFail($id);
        $new_responses = $request->new_responses;
        $extra_responses = $new_responses;
        if($extra_responses >! 0) {
            return redirect()->back()->with('alert-danger', 'Incorrect number!');
        }
        foreach(range(1, $extra_responses) as $vote)
        {
            $Response = $this->Response->create([
                'option_id' => $option->id,
                'ip' => 'fake',
                'agent' => 'fake'
            ]);

//            broadcast(new Vote($option));
        }

        return redirect()->back()->with('alert-success', 'Extra responses added!');
    }
}
