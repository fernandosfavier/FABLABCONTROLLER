<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function mostrarHome(Request $request)
    {
        $usuario = $request->usuario;
        $admin = $request->admin;
        return view('home')->with('usuario', $usuario)->with('admin', $admin);

    }

    public function mostrarHome2(Request $request)
    {
        $usuario = $request->usuario;
        return view('home')->with('usuario', $usuario);

    }
}