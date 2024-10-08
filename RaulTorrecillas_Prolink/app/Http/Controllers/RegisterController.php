<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Company;
use App\Models\Professional;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function start(){
        return view('register/start');
    }

    public function createCompany(){
        return view('register/company');
    }

    public function createProfessional(){
        $categories = Category::all();

        return view('register/professional',[
            'categories' => $categories
        ]);
    }

    public function save(){
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'surname' => ['nullable', 'max:255'],
            'age' => ['nullable', 'numeric'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5'],
            'description' => ['nullable'],
            'location' => ['nullable'],
            'image' => ['nullable', 'image', 'mimes:png'],
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $userData = [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => $attributes['password'],
            'description' => $attributes['description']
        ];

        // Si tiene imagen
        if (request()->hasFile('image') && request()->file('image')->isValid()) {
            $imageName = request()->file('image')->getClientOriginalName();
            request()->file('image')->move(public_path('img'), $imageName);
            $userData['imageUrl'] = '/img/' . $imageName;
        }

        // Crear usuario
        $usuario = User::create($userData);

        // Si tiene apellido, es un profesional
        if (array_key_exists('surname', $attributes)) {
            $professionalData = [
                'surname' => $attributes['surname'],
                'age' => $attributes['age'],
                'category' => ['exists:categories,name']
            ];
            $usuario->professional()->create($professionalData);
        } else {

            // Si no, es una empresa
            $companyData = [
                'location' => $attributes['location'],
            ];
            $usuario->company()->create($companyData);

            Cart::create([
                'company_id' => $usuario->company->id
            ]);
        }

        // Log in
        auth()->login($usuario);

        return redirect('/work')->with('message', 'Has sido registrado con éxito');
    }

}
