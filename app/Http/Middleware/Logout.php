<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
class Logout{

	public function handle($request, Closure $next)
	{
		$user_id = $request->session()->get('user.id');
		
        if ($user_id==null and $user_id=="")
        {
            return redirect('/');
        }
		return $next($request);	
	}
}