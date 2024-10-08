<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function create(){
        $categories = Category::all();

        return view('/Proposals/create',[
            'categories' => $categories
        ]);
    }

    public function save(){
        // Validar los datos de la solicitud
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable'],
            'category' => ['required', 'exists:categories,name'],
            'price_hour' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:png'],
        ]);

        // Obtener la categoría por su nombre
        $category = Category::where('name', $attributes['category'])->first();

        // Verificar si se encontró la categoría
        if (!$category) {
            return redirect()->back()->withErrors('La categoría especificada no existe.');
        }

        // Obtener el ID del usuario profesional, si está disponible
        $professional_id = auth()->user()->professional->id;

        // Construir los datos de la oferta
        $proposalData = [
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'price_hour' => $attributes['price_hour'],
            'category_id' => $category->id,
            'professional_id' => $professional_id,
        ];

        // Si hay una imagen adjunta
        if (request()->hasFile('image') && request()->file('image')->isValid()) {
            $imageName = request()->file('image')->getClientOriginalName();
            request()->file('image')->move(public_path('img'), $imageName);
            $proposalData['imageUrl'] = '/img/' . $imageName;
        }

        // Crear la oferta
        Proposal::create($proposalData);

        return redirect('/')->with('mensaje', 'Oferta creada exitosamente');
    }

    public function list(){
        $proposals = Proposal::with('professional')->paginate(8);

        $categories = Category::whereHas('proposals')->with('proposals')->get();

        $higherPrice = Proposal::max('price_hour');

        return view('/Proposals/proposals',[
            'proposals' => $proposals,
            'categories' => $categories,
            'higherPrice' => $higherPrice
        ]);
    }

    public function filter() {
        $categories = Category::whereHas('proposals')->with('proposals')->get();

        $higherPrice = Proposal::max('price_hour');

        $filters = request()->validate([
            'category' => [],
            'priceRange' => [],
            'filterNumber' => []
        ]);

        if ($filters['category'] != null || isset($filters['filterNumber'])) {

            $query = Proposal::query();

            if ($filters['category'] != null) {
                $category = $filters['category'];

                $query = $query->whereHas('category', function ($query) use ($category) {
                    $query->where('name', $category);
                });
            }

            if (isset($filters['filterNumber']) && $filters['filterNumber'] == 'on') {

                $priceRange = $filters['priceRange'];
                $query = $query->where('price_hour', '<=', $priceRange);
            }

            $proposals = $query->paginate(8);

            return view('/Proposals/proposals',[
                'proposals' => $proposals,
                'categories' => $categories,
                'higherPrice' => $higherPrice
            ]);

        }

        $proposals = Proposal::with('professional')->paginate(8);

        return view('/Proposals/proposals',[
            'proposals' => $proposals,
            'categories' => $categories,
            'higherPrice' => $higherPrice
        ]);
    }

    public function show($id) {

        // Obtener la oferta actual
        $proposal = Proposal::findOrFail($id);

        $recomProposals = [];

        // Verificar si la propuesta tiene una categoría asociada
        if($proposal->category){

            // Obtener hasta 4 propuestas recomendadas de la misma categoría, excluyendo la propuesta actual
            $recomProposals = Proposal::where('category_id', $proposal->category_id)
                ->where('id', '!=', $id)
                ->inRandomOrder() // Aleatorizar el orden de las propuestas recomendadas
                ->take(4)
                ->get();
        }

        return view('/Proposals/proposal',[
            'proposal' => $proposal,
            'recomProposals' => $recomProposals
        ]);
    }

    public function modify($id) {
        $categories = Category::all();

        $proposal = Proposal::findOrFail($id);

        if (auth()->user()->professional->id == $proposal->professional_id || auth()->user()->isAdmin){
            return view('Proposals.modify',[
                'proposal' => $proposal,
                'categories' => $categories
            ]);
        }

        return redirect('/')->with('message','No tienes permiso para acceder');
    }

    public function saveMod($id){
        $proposal = Proposal::findOrFail($id);

        if (auth()->user()->professional->id == $proposal->professional_id || auth()->user()->isAdmin){

            $attributes = request()->validate([
                'name' => ['required', 'max:255'],
                'description' => ['nullable'],
                'category' => ['required', 'exists:categories,name'],
                'price_hour' => ['required', 'numeric'],
                'image' => ['nullable', 'image', 'mimes:png'],
            ]);

            $category = Category::where('name',$attributes['category'])->first();

            // Si tiene imagen, moverla y actualizar la ruta en los atributos
            if (request()->hasFile('image') && request()->file('image')->isValid()) {
                $imageName = request()->file('image')->getClientOriginalName();
                request()->file('image')->move(public_path('img'), $imageName);
                $proposal->imageUrl = '/img/' . $imageName;
            }

            // Actualizar los datos del usuario
            $proposal->name = $attributes['name'];
            $proposal->description = $attributes['description'];
            $proposal->category_id = $category->id;
            $proposal->price_hour = $attributes['price_hour'];

            $proposal->save();

            return redirect('/')->with('message','Datos actualizados exitosamente');

        }
        return redirect('/')->with('message','No tienes permiso para acceder');
    }
}
