<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = Auth::guard('admin')->user();
            if (!$user || (int) ($user->is_admin ?? 0) !== 1) {
                Auth::guard('admin')->logout();
                return redirect()->back()->with('error', 'You do not have admin access.');
            }

            $request->session()->regenerate();

            return redirect()->route('dashboard.index')->with('success', 'You are logged in successfully.');
        }

        return redirect()->back()->withInput($request->only('email'))->with('error', 'Invalid credentials.');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->forget('login_admin_' . sha1('Illuminate\Auth\SessionGuardadmin'));
        $request->session()->regenerateToken();

        return redirect()->route('getLogin')->with('success', 'You have logged out successfully.');
    }
}
