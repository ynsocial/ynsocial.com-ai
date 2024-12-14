<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            Log::info('User already authenticated, redirecting to dashboard');
            return redirect()->route('admin.dashboard.index');
        }

        return view('auth.login');
    }

    public function loginRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        
        // Debug log
        Log::info('Login attempt', [
            'email' => $credentials['email']
        ]);

        // Check if user exists first
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            Log::warning('Login failed - User not found', ['email' => $credentials['email']]);
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'These credentials do not match our records.']);
        }

        Log::info('User found', [
            'email' => $user->email,
            'role' => $user->role
        ]);

        if(Auth::attempt($credentials)) {
            Log::info('Login successful', [
                'user' => Auth::user()->email,
                'role' => Auth::user()->role
            ]);

            $request->session()->regenerate();
            
            if(Auth::user()->isAdmin()) {
                return redirect()->intended(route('admin.dashboard.index'));
            }

            return redirect()->route('home');
        }

        Log::warning('Login failed - Invalid credentials', [
            'email' => $credentials['email']
        ]);

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
