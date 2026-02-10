<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache; // Necesario para hacer peticiones a la API
use Illuminate\Support\Facades\Http; // Para almacenar los datos en caché temporalmente

class RecipeController extends Controller
{
    public function create()
    {
        $ingredients = Cache::remember('zelda_materials', 3600, function () {

            $response = Http::get('https://botw-compendium.herokuapp.com/api/v3/compendium/category/materials');

            return $response->json()['data'];
        });

        $ingredients = collect($ingredients)->sortBy('name')->values();

        return view('recipes.create', compact('ingredients'));
    }
}
