<?php

namespace App\Services\Poll;

use App\Models\Poll;
use App\Events\PollCreated;
use App\DataTransferObject\PollData;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Request;

class PollService
{
    private Poll $poll;
    private PollOptionService $pollOptionService;
    private PollSettingService $pollSettingService;
    private ConnectionInterface $connection;
    private Dispatcher $dispatcher;

    public function __construct(
        Poll $poll, 
        PollOptionService $pollOptionService,
        PollSettingService $pollSettingService,
        ConnectionInterface $connection,
        Dispatcher $dispatcher
    )
    {
        $this->poll = $poll;
        $this->pollOptionService = $pollOptionService;
        $this->pollSettingService = $pollSettingService;
        $this->connection = $connection;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Creates together a poll, options, and savings using a database transaction
     *
     * @param PollData $pollRequestData
     * @return Poll
     */
    public function create(PollData $pollRequestData) : Poll
    {
        $pollData = $pollRequestData->toArray();

        $this->connection->transaction(function() use ($pollData) {
            $poll = $this->initializePoll($pollData);
            $this->addOptions($poll, $pollData['options']);
            $this->addSettings($poll, $pollData['settings']);
        });

        $this->dispatcher->dispatch(new PollCreated($poll));

        return $poll;
    }

    private function initializePoll(array $data) : Poll
    {
        return $this->poll->create([
            'title' => $data['title'],
            'is_active' => 1,
            'ip' => Request::getClientIp()
        ]);
    }

    private function addOptions($poll, array $options) : void
    {   
        foreach($options as $option) {
            $this->pollOptionService->create($poll, ['body' => $option]);
        }
    }

    private function addSettings($poll, array $settings) : void
    {
        foreach($settings as $settingName => $settingValue) {
            $this->pollSettingService->create($poll, [
                $settingName => $settingValue
            ]);
        }
    }
}