<?php

namespace Ajtarragona\Charts\Middlewares;

use Closure;

class ChartsSamplesMiddleware
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
    	if (!config("charts.samples")) {
    		return __("Oops! Chart Samples are disabled");
        }

        return $next($request);
    }
}