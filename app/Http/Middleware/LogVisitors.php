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
            'referer' => str_limit($_SERVER["HTTP_REFERER"] ?? '0', 190),
            'user_agent' => str_limit($_SERVER['HTTP_USER_AGENT'] ?? '0', 190),
            'method' => str_limit($_SERVER['REQUEST_METHOD'] ?? '0', 190),
            'url' => str_limit((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?? '0', 190),
            'language' => str_limit(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2) : '0', 190),
            'created_at' => now(),
            'agent' => new \Jenssegers\Agent\Agent()
        ];

        ProcessVisitor::dispatch($info);


        return $next($request);
    }
}
