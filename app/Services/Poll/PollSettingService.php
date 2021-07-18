<?php

namespace App\Services\Poll;

use App\Models\Poll;
use App\Models\PollSetting;

class PollSettingService
{
    public function create(Poll $poll, array $setting) : PollSetting
    {
        dd($setting);
        return $poll->settings()->create($setting);
    }
}