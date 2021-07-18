<?php

namespace App\Filters\PollSettings;

use App\Models\Poll;

class BlockMultipleVotes implements PollSettingInterface
{
    public function passes(Poll $poll, ) : bool
    {
        // $votes = $poll->votes();

        return true;
    }
}