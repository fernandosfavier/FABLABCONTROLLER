<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class logincontroller extends Controller
{
    public function mostrarloginteste(Request $request)
    {
        return view('loginteste');
    }
}
