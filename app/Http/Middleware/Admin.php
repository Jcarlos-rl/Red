<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) 
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			} 
			else 
			{
				return redirect()->guest('login');
			}
        } 
		else if (Auth::guard($guard)->user()->roles!='aa' && Auth::guard($guard)->user()->roles!='ae' && Auth::guard($guard)->user()->roles!='ap') 
		{
			return redirect()->to('/user/eventos')->withError('Permission Denied');
        }

        return $next($request);
    }
}
