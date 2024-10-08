<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Professional;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show($id){
        $user = User::findOrFail($id);

        if ($user->professional){

            $proposals = $user->professional->proposals()->paginate(4);
            $working_experience = $user->professional->working_experiences()->get();

            return view('Users.user',[
                'user' => $user,
                'proposals' => $proposals,
                'working_experience' => $working_experience
            ]);

        }

        return view('Users.user',[
            'user' => $user
        ]);
    }

    public function verify($id){
        if (auth()->user()->id == $id || auth()->user()->isAdmin){

            $user = User::findOrFail($id);

            return view('Users.verify',[
                'user' => $user
            ]);
        }
        return redirect('/')->with('message','No tienes permiso para acceder');
    }

    public function delete(Request $request, $id){
        $user = User::findOrFail($id);

        if ($user->id == auth()->user()->id || auth()->user()->isAdmin){

            if (Hash::check($request->input('password'),auth()->user()->password)){

                if ($request->input('password') == $request->input('rePassword')) {

                    if ($user->id != 1) {

                        $user->delete();

                        return redirect('/')->with('message', 'Usuario eliminado exitosamente');
                    }

                    return redirect()->back()->with('message', 'El admin Pepe es inmortal');
                }
                return redirect()->back()->with('error', 'Las contraseñas no coinciden');
            }
            return redirect()->back()->with('error', 'La contraseña es incorrecta');
        }
        return redirect()->back()->with('message','No puedes acceder');

    }

    public function modify($id){
        if (auth()->user()->id == $id || auth()->user()->isAdmin){

            $user = User::findOrFail($id);

            if ($user->professional){
                $working_experience = $user->professional->working_experiences()->get();

                return view('Users.modify',[
                    'user' => $user,
                    'working_experience' => $working_experience,
                    'i' => 0
                ]);
            }
            return view('Users.modify',[
                'user' => $user
            ]);
        }
        return redirect('/')->with('message','No tienes permiso para acceder');
    }

    public function saveMod($id){
        if (auth()->user()->id == $id || auth()->user()->isAdmin){

            $user = User::findOrFail($id);

            $attributes = request()->validate([
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
                'description' => ['nullable'],
                'image' => ['nullable', 'image', 'mimes:png']
            ]);

            // Si tiene imagen, moverla y actualizar la ruta en los atributos
            if (request()->hasFile('image') && request()->file('image')->isValid()) {
                $imageName = request()->file('image')->getClientOriginalName();
                request()->file('image')->move(public_path('img'), $imageName);
                $user->imageUrl = '/img/' . $imageName;
            }

            // Actualizar los datos del usuario
            $user->name = $attributes['name'];
            $user->email = $attributes['email'];
            $user->description = $attributes['description'];

            $user->save();

            if ($user->company){

                $companyAttributes = request()->validate([
                    'location' => ['nullable']
                ]);

                $company = Company::where('user_id',$user->id)->first();
                $company->location = $companyAttributes['location'];
                $company->save();

            } elseif ($user->professional){

                $professionalAttributes = request()->validate([
                    'surname' => ['nullable', 'max:255'],
                    'age' => ['required', 'numeric']
                ]);

                $professional = Professional::where('user_id',$user->id)->first();
                $professional->surname = $professionalAttributes['surname'];
                $professional->age = $professionalAttributes['age'];
                $professional->save();

                $workingExperiences = $professional->working_experiences()->get();

                $validatedWorkingExperiences = request()->validate([
                    'company_name.*' => ['required', 'max:255'],
                    'begins_at.*' => ['required', 'date'],
                    'ends_at.*' => ['nullable','date'],
                    'work_description.*' => ['required'],
                ]);

                // Validar y actualizar cada experiencia laboral
                $key = 0;
                foreach($workingExperiences as $experience) {

                    $experience->company_name = $validatedWorkingExperiences['company_name'][$key];
                    $experience->begins_at = $validatedWorkingExperiences['begins_at'][$key];
                    $experience->ends_at = $validatedWorkingExperiences['ends_at'][$key];
                    $experience->description = $validatedWorkingExperiences['work_description'][$key];

                    $experience->save();
                    $key++;
                }

            }

            return redirect('/')->with('message','Datos actualizados exitosamente');
        }
        return redirect('/')->with('message','No tienes permiso para acceder');
    }

    public function list(){
        $id = auth()->user()->id;

        $users = User::where('id', '!=', $id)->paginate(8);

        return view('Users.users',[
           'users' => $users
        ]);

    }

    public function filter(){
        $type = request()->category;

        if ($type == 'professional'){
            $users = User::whereHas('professional')->paginate(8);

            return view('Users.users',[
                'users' => $users
            ]);
        } elseif ($type == 'company'){
            $users = User::whereHas('company')->paginate(8);

            return view('Users.users',[
                'users' => $users
            ]);
        }

        return $this->list();
    }

}
