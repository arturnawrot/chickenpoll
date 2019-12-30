<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Arturek1\Screenshot\Screenshot;
use App\Models\Poll;
use Intervention\Image\Facades\Image;

class GenerateThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $poll;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Screenshot $screenshot)
    {
        $url = route('polls.show', $this->poll->slug);
        if(app()->isLocal()) {
            $url = "https://chickenpoll.com/what-windows-do-you-use";
        }
        $base64 = $screenshot->get($url);
        $path = "thumbnails/{$this->poll->slug}.jpeg";
        Image::make(file_get_contents($base64))->save(public_path($path));
        $this->poll->thumbnail()
            ->updateOrCreate(['poll_id' => $this->poll->id], ['path' => $path])
            ->touch();
    }
}
