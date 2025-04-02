<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $loggedInUserRole = $request ->user()->role;
        $loggedInUserId = $request ->user()->id;
        DB::insert("INSERT INTO users_logs (id, timestamp_at) VALUES ($loggedInUserId, CURRENT_TIMESTAMP)");

        if($loggedInUserRole == 'admin'){
            return redirect()->intended(route('admin.dashboard-main', absolute: false));

        }else if($loggedInUserRole == 'manager'){
            return redirect()->intended(route('manager.dashboard', absolute: false));

        }else if($loggedInUserRole == 'full_time'){
            return redirect()->intended(route('full_time.dashboard', absolute: false));

        }else if($loggedInUserRole == 'part_time'){
            return redirect()->intended(route('part_time.dashboard', absolute: false));

        }else{

        return redirect()->intended(route('dashboard', absolute: false));
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
