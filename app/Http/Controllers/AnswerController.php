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
            'options_id' => 'min:1|required'
        ];

        // Error messages
        $messages = [
            'options_id.required' => 'You have not selected any option(s)',
            'g-recaptcha-response.required' => 'Please complete the captcha',
        ];

        // Validate request (To check if `option_id` exists)
        $request->validate($rules, $messages);

        $option = $this->option->find($request->options_id[0]);

        $settings = $option->poll->settings;
        if($settings->contains('value', 'captcha')) {
            // Check if captcha protection is enabled
            $rules['g-recaptcha-response'] = 'required|recaptcha';
        }

        // Validate request again (After checking if captcha is enabled)
        $request->validate($rules, $messages);

        // Check the IP address to prevent multiple sumbissions
        if($settings->contains('value', 'ip_checking')) {
            $answers = $option->poll->votes;
            foreach($answers as $answer)
            {
                if($answer->ip == $_SERVER['REMOTE_ADDR']) {
                    return redirect()->back()->with('alert-danger', 'You have already voted :)');
                }
            }
        }

        // Save the vote(s)
        $isMultipleChoice = $settings->contains('value', 'multiple_choice');
        foreach($request->options_id as $option_id)
        {
            $answer = $this->answer->create([
                'option_id' => $option_id,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'agent' => $_SERVER['HTTP_USER_AGENT'],
            ]);
            if(!$isMultipleChoice) {
                break;
            }
        }

        // Send a websocket
        broadcast(new Vote($this->option->find($request->options_id)));

        return redirect()->back()->with('alert-success', 'Thank you for your vote!');
    }
}
