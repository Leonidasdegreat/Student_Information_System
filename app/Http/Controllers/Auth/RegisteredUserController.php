<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Common validation rules
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users', 'unique:students'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|in:student,admin',
            'address' => ['nullable', 'string', 'max:255'], // Allow address to be nullable
            'age' => ['nullable', 'integer'],              // Allow age to be nullable
        ]);

        // Additional validation for students
        if ($request->role === 'student') {
            $request->validate([
                'address' => ['nullable', 'string', 'max:255'],
                'age' => ['nullable', 'integer'],
            ]);
        }

        // Create user based on role
        if ($request->role === 'student') {
            $user = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'address' => $request->address,
                'age' => $request->age,
                'email_verified_at' => now(), // Automatically verify email
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('students.index', absolute: false));
    }
}
