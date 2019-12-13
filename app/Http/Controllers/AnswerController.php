<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\AnswerRepositoryInterface as Answer;

class AnswerController extends Controller
{
    private $answer;

    function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function store(Request $request)
    {
        $answer = $this->answer->create([
            'option_id' => $request->option_id,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'os' => 'os',
            'browser' => 'browser'
        ]);

        return redirect()->back();
    }
}
