<?php

namespace App\Filters\PollSettings;

use App\Filters\FilterInterface;
use Spatie\DataTransferObject\DataTransferObject;
use App\Models\Poll;

interface PollSettingInterface extends FilterInterface
{
    public function detect(Poll $poll): bool;
}