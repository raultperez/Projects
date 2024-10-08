<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $professionals = Professional::with('user')->paginate(4);

        return view('home',[
            'professionals' => $professionals
        ]);
    }
}
