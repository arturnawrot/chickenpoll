<?php

namespace App\DataTransferObject;

use Spatie\DataTransferObject\DataTransferObject;

class PollData extends DataTransferObject
{
    /*
    * @var string 
    */
    public string $title;
    
    /*
    * @var \App\Models\PollOption[]
    */
    public array $options;

    /*
    * @var \App\Models\PollSettings[]
    */
    public array $settings;
}