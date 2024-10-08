<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
        return view('Proposals.category');
    }

    public function save() {
        // Validar la entrada inicial
        $attributes = request()->validate([
            'name' => ['required', 'max:255']
        ]);

        // Normalizar el nombre de la categoría (eliminar espacios y convertir a minúsculas)
        $normalizedName = strtolower(trim(preg_replace('/\s+/', '', $attributes['name'])));

        // Comprobar si la categoría ya existe
        $existingCategory = Category::whereRaw('LOWER(REPLACE(name, " ", "")) = ?', [$normalizedName])->first();

        if ($existingCategory) {
            return redirect()->back()->withErrors(['name' => 'La categoría ya existe.'])->withInput();
        }

        // Crear la nueva categoría
        Category::create($attributes);

        return redirect('/create')->with('message', 'Categoria creada');
    }
}
