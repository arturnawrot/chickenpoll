<?php

namespace App\Factories;

use App\Models\PollSetting;

class SettingsFactory
{
    const VALID_SETTINGS = ['']
    /**
     * Creates an PollSetting Eloquent entity from an array 
     *
     * @param array $settings Example: ["recaptcha" => 0, "ip_checking" => 1]
     * @return void
     */
    public function create(array $settings)
    {
        $pollSetting = new PollSetting;

        foreach()
    }

    private function isValid(string $setting)
    {

    }
}