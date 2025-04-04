<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');

        }

        $userRole = Auth::user()->role;

        if($userRole == 'admin'){
            return $next($request);

        }else if ($userRole == 'manager'){
            return redirect()->route('manager.dashboard');

        }else if ($userRole == 'fulltime'){
            return redirect()->route('full_time.dashboard');

        }else if($userRole == 'parttime'){
            return redirect()->route('part_time.dashboard');

        }else{
            return redirect()->route('dashboard');

        }
    }
}
