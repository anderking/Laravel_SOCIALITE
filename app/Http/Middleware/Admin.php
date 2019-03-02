<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        if(Auth::user())
        {
            if ($this->auth->user()->admin() || $this->auth->user()->superadmin())
                return $next($request);
            else
            {
                //$user_id = Auth::user()->id;
                //return redirect()->route('member.profiel.show',$user_id);
                abort(404);
            }
        }
    }
}
