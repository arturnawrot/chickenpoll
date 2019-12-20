<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Visitor;

class ProcessVisitor extends Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $info;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $info = $this->info;
        $geoip = geoip($info['ip']);
        $agent = $info['agent'];

        $visitor = [
            'ip' => $info['ip'],
            'method' => $info['method'],
            'url' => $info['url'],
            'referer' => $info['referer'],
            'agent' => $info['user_agent'],
            'type' => $agent->device(),
            'is_bot' => (int)$agent->isRobot(),
            'os' => $agent->platform(),
            'browser' => $agent->browser(),
            'country' => $geoip['country'],
            'country_code' => $geoip['iso_code'],
            'city' => $geoip['city'],
            'lat' => $geoip['lat'],
            'long' => $geoip['lon'],
            'language' => $info['language']
        ];

        Visitor::Create($visitor);
    }
}
