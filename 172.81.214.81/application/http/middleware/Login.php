<?php

namespace app\http\middleware;

class Login
{
    public function handle($request, \Closure $next)
    {

		if(!session('mobile')){
			return redirect('/login');
		}

		return $next($request);
    }
}
