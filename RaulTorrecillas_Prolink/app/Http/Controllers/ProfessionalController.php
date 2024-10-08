<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Professional;
use App\Models\Working_experience;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class ProfessionalController extends Controller
{
    public function list(){
        $professionals = Professional::with('user')->paginate(8);

        $categories = Category::whereHas('professionals')->with('professionals')->get();

        return view('/Users/professionals',[
            'professionals' => $professionals,
            'categories' => $categories
        ]);
    }

    public function createWork(){
        return view('Users.work');
    }

    public function saveWork(){

        $attributes = request()->validate([
            'company_name' => ['required', 'max:255'],
            'begins_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date'],
            'description' => ['required']
        ]);

        // Obtener el ID del usuario profesional, si está disponible
        $professional_id = auth()->user()->professional->id;

        $working_attributes = [
            'begins_at' => $attributes['begins_at'],
            'ends_at' => $attributes['ends_at'],
            'company_name' => $attributes['company_name'],
            'description' => $attributes['description'],
            'professional_id' => $professional_id
        ];

        Working_experience::create($working_attributes);

        $user_id = auth()->user()->id;

        return redirect('/user/'.$user_id)->with('mensaje','¡Experiencia Laboral creada!');

    }

    public function deleteWork($id){
        $work = Working_experience::findOrFail($id);

        $work->delete();

        return redirect()->back();
    }

    public function filter() {
        $categories = Category::whereHas('professionals')->with('professionals')->get();

        $filter = request()->validate([
            'category' => []
        ]);

        if ($filter['category'] != null) {

            $query = Professional::query();

            $category = $filter['category'];

            $query = $query->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            });

            $professionals = $query->paginate(8);

            return view('Users.professionals',[
                'professionals' => $professionals,
                'categories' => $categories
            ]);

        }

        $professionals = Professional::with('user')->paginate(8);

        return view('Users.professionals',[
            'professionals' => $professionals,
            'categories' => $categories
        ]);
    }
}
