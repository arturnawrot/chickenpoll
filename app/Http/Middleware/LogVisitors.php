<?php

namespace App\Http\Middleware;

use Closure;
use App\Jobs\ProcessVisitor;

class LogVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Middleware part
        $ip = $_SERVER['REMOTE_ADDR'];

        $info = [
            'ip' => $ip,
            'referer' => $_SERVER["HTTP_REFERER"] ?? '0',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'method' => $_SERVER['REQUEST_METHOD'],
            'url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
            'language' => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2),
            'created_at' => now(),
            'agent' => new \Jenssegers\Agent\Agent()
        ];

        ProcessVisitor::dispatch($info);


        return $next($request);
    }
}
