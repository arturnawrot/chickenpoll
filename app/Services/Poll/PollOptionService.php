<?php

namespace App\Services\Poll;

use App\Models\Poll;
use App\Models\PollOption;

class PollOptionService
{
    public function create(Poll $poll, array $data) : PollOption
    { 
        // return $poll->options()->saveMany();
        return new PollOption();
    }
}