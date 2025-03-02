<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        if (Auth::check()) {
            return $this->redirectUser(Auth::user()); // Use a helper function
        }

        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate as a user (admin)
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectUser(Auth::guard('web')->user());
        }

        // Attempt to authenticate as a student
        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectUser(Auth::guard('student')->user());
        }

        logger('Attempting login with credentials:', $credentials);
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    private function redirectUser($user): RedirectResponse
    {
        if ($user->role === 'student') {
            return redirect()->route('studentviews.index');
        } elseif ($user->role === 'admin') {
            return redirect()->route('students.index');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout(); // Logout the user

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to homepage after logout
    }

}
