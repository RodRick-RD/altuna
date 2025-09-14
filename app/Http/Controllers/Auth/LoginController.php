<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check()) {
            $role = auth()->user()->role;

            return match ($role) {
                'administrador' => redirect('/dashboard'),
                'supervisor'    => redirect('/dashboard'),
                'cliente'       => redirect('/dashboard'),
                default         => redirect('/dashboard'),
            };
        }
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        // 1. Validar
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ],[
            'g-recaptcha-response.required' => 'El captcha es obligatorio.',
        ]);

        // 2. Solo tomar email y password como credenciales
        $credentials = $request->only('email', 'password');

        // 3. Intentar login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            if ($user->estado != 1) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Tu cuenta aún no ha sido activada.',
                ])->withInput($request->only('email'));
            }

            $request->session()->regenerate();

            // Redirigir según el rol
            $role = $user->role;
            return match ($role) {
                'cliente' => redirect()->intended('/dashboard'),
                default   => redirect()->intended('/dashboard'),
            };
        }

        // Error de autenticación
        return back()->withErrors([
            'email' => 'Las credenciales no son válidas.',
        ])->withInput($request->only('email'));
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
