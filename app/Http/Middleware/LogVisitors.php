<?php

namespace App\Http\Middleware;

use Closure;
use App\Jobs\ProcessVisitor;
use Illuminate\Support\Str;

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
            'referer' => Str::limit($_SERVER["HTTP_REFERER"] ?? '0', 190),
            'user_agent' => Str::limit($_SERVER['HTTP_USER_AGENT'] ?? '0', 190),
            'method' => Str::limit($_SERVER['REQUEST_METHOD'] ?? '0', 190),
            'url' => Str::limit((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?? '0', 190),
            'language' => Str::limit(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ? substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2) : '0', 190),
            'created_at' => now(),
            'agent' => new \Jenssegers\Agent\Agent()
        ];

        ProcessVisitor::dispatch($info);


        return $next($request);
    }
}
