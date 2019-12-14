<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\AnswerRepositoryInterface as Answer;
use App\Repositories\Contracts\OptionRepositoryInterface as Option;

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

        // Check if captcha protection is enabled
        $rules['g-recaptcha-response'] = 'required|recaptcha';

        // Error messages
        $messages = [
            'option_id.required' => 'You did not select any option',
            'g-recaptcha-response.required' => 'Please complete the captcha',
        ];

        // Validate request
        $request->validate($rules, $messages);

        // Check the IP address to prevent multiple sumbissions
        $answers = $this->option->find($request->option_id)->poll->votes;
        foreach($answers as $answer)
        {
            if($answer->ip == $_SERVER['REMOTE_ADDR']) {
                return redirect()->back()->with('alert-danger', 'You already voted :)');
            }
        }

        $answer = $this->answer->create([
            'option_id' => $request->option_id,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'os' => 'os',
            'browser' => 'browser'
        ]);

        return redirect()->back();
    }
}
