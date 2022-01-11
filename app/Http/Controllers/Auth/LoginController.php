<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',

        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)){ // sinaliza para guardar remember toke da sessão
            return back()->with('status', 'Invalid login details'); //define uma mensagem na sessão anterior
            // back()=shortcut  to return previous page user visited
            //with() coloca algo na sessão em formato classe
        }

        return redirect()->route('dashboard');
    }
}
