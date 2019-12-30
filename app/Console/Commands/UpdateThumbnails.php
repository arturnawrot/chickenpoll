<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Poll;
use App\Jobs\GenerateThumbnail;

class UpdateThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:thumbnails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update thumbnails of polls';

    private $poll;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Poll $poll)
    {
        parent::__construct();

        $this->poll = $poll;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $polls = $this->poll->all();

        foreach($polls as $poll)
        {
            if(!isset($poll->thumbnail)) {
                GenerateThumbnail::dispatch($poll);
            } else {
                if((Bool) $poll->votes()->get()->where('created_at', '>', $poll->thumbnail->updated_at)->last()) {
                    GenerateThumbnail::dispatch($poll);
                }
            }
        }
    }
}
