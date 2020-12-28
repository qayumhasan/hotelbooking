
<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRedirectIfAuthenticated
{
  
    public function handle(Request $request, Closure $next, ...$guards)
    {
       
            if (Auth::guard($guard)->check()) {
                return redirect()->route('admin.dashboard');
            }
        
        return $next($request);
  
    }
}
