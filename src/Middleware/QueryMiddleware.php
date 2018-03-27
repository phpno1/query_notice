<?php

namespace BugsLife\QueryNotice\Middleware;

use BugsLife\QueryNotice\Notice;
use Closure;

class QueryMiddleware
{
    public $notice;

    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }

    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->notice->notice();
        $response = $next($request);
        return $response;
    }
}
