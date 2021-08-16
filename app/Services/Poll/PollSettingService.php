<?php

namespace App\Services\Poll;

use App\Models\Poll;
use App\Models\PollSetting;

class PollSettingService
{
    public function create(Poll $poll, array $settings) : array
    {   
        $settings = array_map(function ($settingName, $settingValue) {
            return new PollSetting([
                'name' => $settingName,
                'value' => $settingValue
            ]);
        }, array_keys($settings), $settings);

        return $poll->settings()->saveMany($settings);
    }
}