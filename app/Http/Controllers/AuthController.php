<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El usuario o correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico es inválido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        // First check if the user exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withErrors(['email' => 'El usuario o correo electrónico ingresado no existe en nuestro sistema.'])
                ->withInput($request->except('password'));
        }

        // Check if the password is correct
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['password' => 'La contraseña ingresada es incorrecta.'])
                ->withInput($request->except('password'));
        }

        // Check if user is active
        if (!$user->isActive()) {
            return back()
                ->withErrors(['email' => 'Tu cuenta está inactiva. Contacta al administrador.'])
                ->withInput($request->except('password'));
        }

        // Log the user in
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Show link request form for password recovery
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send reset link email
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico es inválido.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withErrors(['email' => 'El usuario o correo electrónico ingresado no existe en nuestro sistema.'])
                ->withInput();
        }

        return back()->with('success', 'Hemos enviado las instrucciones para restablecer tu contraseña a tu correo electrónico.');
    }

    /**
     * Show registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'colaborador',
            'status' => 'activo',
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
