<?php

namespace farmacia\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;

use Closure;
use Session;
use Auth;

class ventas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if( Auth::check() )
        {
            return redirect()->to('/login');
        }
        return $next($request);
    }

}
