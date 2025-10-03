<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerProveedor extends Controller
{
    public function index(){
        return view('proveedor.index');
    }
}
