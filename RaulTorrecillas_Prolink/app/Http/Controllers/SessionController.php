<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
    public function destroy(){
        auth()->logout();
        return redirect('/')->with('message','Sesión cerrada con éxito');
    }

    public function login(){
        $attributes = request()->validate([
            'email' => ['required','email','max:255'],
            'password' => ['required']
        ]);

        if (auth()->attempt($attributes)){
            session()->regenerate();
            return redirect('/home')->with('message','Sesión iniciada con éxito');
        }

        return back()
            ->withInput()
            ->withErrors(['error' => 'Credenciales inválidas']);
    }

}
