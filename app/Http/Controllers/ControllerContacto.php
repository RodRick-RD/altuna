<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ControllerContacto extends Controller
{
    public function enviar(Request $request){
        // 1. Validar el formulario
        $data = $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            // 2. Guardar en base de datos
            $mensaje = new Contacto();
            $mensaje->nombre  = $data['name'];
            $mensaje->correo   = $data['email'];
            $mensaje->asunto  = $data['subject'];
            $mensaje->mensaje = $data['message'];
            $mensaje->save();

            // 3. Enviar correo de bienvenida al remitente
            Mail::send('emails.bienvenida', [
                'nombre' => $data['name'],
                'asunto' => $data['subject']
            ], function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                        ->subject('Gracias por contactarnos');
            });

            return response()->json([
                'message' => 'Tu mensaje ha sido enviado y te enviamos un correo de confirmación.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al enviar el mensaje.'
            ], 500);
        }

    }
}
