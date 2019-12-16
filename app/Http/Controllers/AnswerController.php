<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\AnswerRepositoryInterface as Answer;
use App\Repositories\Contracts\OptionRepositoryInterface as Option;
use App\Events\Vote;

class AnswerController extends Controller
{
    private $answer;
    private $option;

    function __construct(Answer $answer, Option $option)
    {
        $this->answer = $answer;
        $this->option = $option;
    }

    public function store(Request $request)
    {
        $rules = [
            'option_id' => 'required|integer'
        ];

        // Error messages
        $messages = [
            'option_id.required' => 'You did not select any option',
            'g-recaptcha-response.required' => 'Please complete the captcha',
        ];

        $option = $this->option->find($request->option_id);
        $settings = $option->poll->settings();

        if($settings->where('value', 'captcha')->exists()) {
            // Check if captcha protection is enabled
            $rules['g-recaptcha-response'] = 'required|recaptcha';
        }

        // Validate request
        $request->validate($rules, $messages);

        // Check the IP address to prevent multiple sumbissions
        if($option->poll->settings()->where('value', 'ip_checking')->exists()) {
            $answers = $option->poll->votes;
            foreach($answers as $answer)
            {
                if($answer->ip == $_SERVER['REMOTE_ADDR']) {
                    return redirect()->back()->with('alert-danger', 'You already voted :)');
                }
            }
        }

        // Save the vote
        $answer = $this->answer->create([
            'option_id' => $request->option_id,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'agent' => 'agent'
        ]);

        // Send a websocket
        broadcast(new Vote($option));

        return redirect()->back();
    }
}
