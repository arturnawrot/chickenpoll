<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Option;
use App\Events\Vote;

class ResponseController extends Controller
{
    private $response;
    private $option;

    function __construct(Response $response, Option $option)
    {
        $this->response = $response;
        $this->option = $option;
    }

    public function store(Request $request)
    {
        $option = $this->option->findOrFail($request->options_id[0]);
        $poll = $option->poll;
        $settings = $poll->validationRules();
        $request->validate($settings['rules'], $settings['messages']);

        $responses = $option
            ->responses()
            ->where('ip', $_SERVER['REMOTE_ADDR'])            
            ->pluck('ip')
            ->toArray();

        if(in_array($_SERVER['REMOTE_ADDR'], $responses)) {
            return redirect()->route('results.show', $option->poll->slug)->with('alert-danger', 'You have already voted :)');
        }

        $options_id = !$poll->hasSetting('multiple_choice')
                        ? [$request->options_id[0]]
                        : $request->options_id;    

        foreach($options_id as $option_id)
        {
            $response = $this->response->create([
                'option_id' => $option_id,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'agent' => $_SERVER['HTTP_USER_AGENT'],
            ]);
        }

        // Send a websocket
        broadcast(new Vote($this->option->find($request->options_id)));

        return redirect()->route('results.show', $option->poll->slug)->with('alert-success', 'Thank you for your vote!');
    }
}
