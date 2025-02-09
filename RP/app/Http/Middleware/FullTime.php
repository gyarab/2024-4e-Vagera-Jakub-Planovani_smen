<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class FullTime
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
            return redirect()->route('admin.dashboard');

        }else if ($userRole == 'manager'){
            return redirect()->route('manager.dashboard');

        }else if ($userRole == 'full_time'){
            return $next($request);

        }else if($userRole == 'part_time'){
            return redirect()->route('part_time.dashboard');

        }else{
            return redirect()->route('dashboard');

        }
    }
}
