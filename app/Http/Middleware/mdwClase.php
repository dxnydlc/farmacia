<?php

namespace farmacia\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;


use Closure;
use Session;


class mdwClase
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
        if( $this->auth->User()->type != 'Administrador'  )
        {
            #return 'no login';
            Session::flash('message-error','No tiene privilegios');
            return redirect()->to('/login');
        }
        return $next($request);
    }
}
