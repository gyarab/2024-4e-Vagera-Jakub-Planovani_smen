<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Device;

class VerifyDeviceToken
{
    protected $except = [
        '/chatify/api/chat/auth', // Add your exact URL
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $deviceToken = $request->header('Device-Token'); // Get the token from headers

        // Check if the token exists in the database
        $device = Device::where('device_token', $deviceToken)->first();

        if (!$device) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request); 
    }
}
