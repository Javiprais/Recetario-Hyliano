<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RecipeController::class, 'create'])->name('recipes.create');
Route::get('/recetas', [RecipeController::class, 'index'])->name('recipes.index');

Route::get('/recetas/crear', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/recetas', [RecipeController::class, 'store'])->name('recipes.store');
