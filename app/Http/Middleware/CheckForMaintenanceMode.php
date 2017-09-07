<?php

namespace App\Http\Middleware;

use Closure;

class CheckForMaintenanceMode extends \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode
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
        if ($this->app->isDownForMaintenance() && !in_array($request->ip(), ['31.161.117.118']))
        {
            return response('xxx is in onderhoud. Excuses voor het ongemak.', 503);
        }
        return $next($request);
    }
} 
