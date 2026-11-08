<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user)
    {
        $name = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
        if ($name === '') {
            $name = $user->email ?? 'back';
        }

        return redirect()->intended(route('profile.show'))->with('success', 'Welcome back, ' . $name . '!');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->forget('login_web_' . sha1('Illuminate\Auth\SessionGuardweb'));
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have logged out successfully.');
    }
}
