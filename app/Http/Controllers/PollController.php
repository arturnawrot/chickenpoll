<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePollRequest;
use App\Services\Poll\PollService;

class PollController extends Controller
{
    private $pollService;

    public function __construct(PollService $pollService)
    {
        $this->pollService = $pollService;
    }

    public function store(StorePollRequest $request)
    {
        $data = $request->getDto();

        $poll = $this->pollService->create($data);
    }
}