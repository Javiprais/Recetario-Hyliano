<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return view('home');
});

Route::get('/recetas/crear', [RecipeController::class, 'create'])->name('recipes.create');
