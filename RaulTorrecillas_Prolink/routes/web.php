<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Landing
Route::get('/', function () {return view('landing');})
    ->middleware('guest')
    ->name('login');

// Register
Route::get('/register',[RegisterController::class,'start'])
    ->middleware('guest')
    ->name('register');

Route::get('/register/empresa',[RegisterController::class,'createCompany'])
    ->middleware('guest');

Route::get('/register/profesional',[RegisterController::class,'createProfessional'])
    ->middleware('guest');

Route::post('/register',[RegisterController::class,'save'])
    ->middleware('guest');

// Sessions
Route::post('/login',[SessionController::class,'login'])
    ->middleware('guest');

Route::get('logout',[SessionController::class,'destroy'])
    ->middleware('auth');

// Index
Route::get('/home',[IndexController::class,'index'])
    ->middleware('auth');

// Proposals
Route::get('/proposals',[ProposalController::class,'list'])
    ->middleware('auth');

Route::post('/proposals',[ProposalController::class,'filter'])
    ->middleware('auth');

Route::get('/proposals/{id}',[ProposalController::class,'show'])
    ->middleware('auth');

Route::post('/proposals/{id}',[CartController::class,'add'])
    ->middleware('company');

Route::get('/create',[ProposalController::class,'create'])
    ->middleware('professional');

Route::post('/create',[ProposalController::class,'save'])
    ->middleware('professional');

Route::get('/proposals/{id}/modify',[ProposalController::class,'modify'])
    ->middleware('auth');

Route::post('/proposals/{id}/modify',[ProposalController::class,'saveMod'])
    ->middleware('auth');

// Cartegories
Route::get('/createCategory',[CategoryController::class,'create'])
    ->middleware('auth');

Route::post('/createCategory',[CategoryController::class,'save'])
    ->middleware('auth');

// Users
Route::get('/user/{id}',[UserController::class,'show'])
    ->middleware('auth');

Route::get('/user/{id}/delete',[UserController::class,'verify'])
    ->middleware('auth');

Route::post('/user/{id}/delete',[UserController::class,'delete'])
    ->middleware('auth');

Route::get('/user/{id}/modify',[UserController::class,'modify'])
    ->middleware('auth');

Route::post('/user/{id}/modify',[UserController::class,'saveMod'])
    ->middleware('auth');

Route::get('/users',[UserController::class,'list'])
    ->middleware('admin');

Route::post('/users',[UserController::class,'filter'])
    ->middleware('admin');

// Professionals
Route::get('/work',[ProfessionalController::class,'createWork'])
    ->middleware('professional');

Route::post('/work',[ProfessionalController::class,'saveWork'])
    ->middleware('professional');

Route::get('/work/{id}',[ProfessionalController::class,'deleteWork'])
    ->middleware('professional');

Route::get('/professionals',[ProfessionalController::class,'list'])
    ->middleware('auth');

Route::post('/professionals',[ProfessionalController::class,'filter'])
    ->middleware('auth');

// Cart
Route::get('/cart',[CartController::class,'list'])
    ->middleware('company');

Route::post('/cart/{id}',[CartController::class,'order'])
    ->middleware('company');

Route::post('/cart/{id}/increase',[CartController::class,'increase'])
    ->middleware('company');

Route::post('/cart/{id}/decrease',[CartController::class,'decrease'])
    ->middleware('company');
