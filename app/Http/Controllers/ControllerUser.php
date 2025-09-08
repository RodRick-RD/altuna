<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ControllerUser extends Controller
{
    public function create()
    {
        return view('form.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'direccion' => 'nullable|string',
            'ciudad' => 'nullable|string',
            'departamento' => 'nullable|string',
            'pais' => 'nullable|string',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
        ]);

        $codigo = Str::random(40);

        $user = new User();
        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'cliente';
        $user->direccion = $request->direccion;
        $user->ciudad = $request->ciudad;
        $user->departamento = $request->departamento;
        $user->pais = $request->pais;
        $user->latitud = $request->latitud;
        $user->longitud = $request->longitud;
        $user->codigo_verificacion = $codigo;
        $user->save();


        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'codigo' => $codigo,
        ];

        // Enviar correo de verificación
        Mail::send('emails.verificacion', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])
                    ->subject('Activa tu cuenta');
        });

        return redirect()->route('login')->with('success', 'Usuario registrado. le enviamos un mensaje de validación a a su correo para activar su cuenta.');
    }


    public function verificarCuenta($codigo)
    {
        $user = User::where('codigo_verificacion', $codigo)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Código de verificación inválido o expirado.');
        }

        $user->estado = 1;
        $user->codigo_verificacion = null;
        $user->save();

        return redirect()->route('login')->with('confirm', 'Tu cuenta fue activada correctamente.');
    }


    public function edit()
    {
        $user = auth()->user();
        return view('client.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'phone' => 'required|string|max:12',
                'password' => 'nullable|confirmed|min:6',
                'direccion' => 'nullable|string',
                'ciudad' => 'nullable|string',
                'departamento' => 'nullable|string',
                'pais' => 'nullable|string',
                
            ]);

            $user->name = $request->name;
            $user->lastName = $request->lastName;
            $user->phone = $request->phone;
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'La contraseña actual no es correcta.',
                ]);
            }
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->direccion = $request->direccion;
            $user->ciudad = $request->ciudad;
            $user->departamento = $request->departamento;
            $user->pais = $request->pais;

            
            $user->save();

            return redirect()->back()->with('success', 'Datos actualizados correctamente');
    }
    public function dashboard()
    {
        $carrito = session('carrito', []);
        $cantidadProductosCarrito = count($carrito);
        return view('dashboard.index', compact('cantidadProductosCarrito'));
    }
    
}
