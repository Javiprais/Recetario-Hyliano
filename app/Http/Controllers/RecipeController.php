<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // Necesario para hacer peticiones a la API
use Illuminate\Support\Facades\Http; // Para almacenar los datos en caché temporalmente
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'effect' => 'required|string',
            'api_ingredients' => 'required|array|min:1|max:5',
        ], [
            // mensajes de error personalizados
            'api_ingredients.required' => 'Elige al menos un ingrediente.',
            'api_ingredients.max' => 'Máximo 5 ingredientes.',
        ]);

        $userId = 1;
        if (Auth::check()) {
            $userId = Auth::id();
        }

        $recipe = \App\Models\Recipe::create([
            'user_id' => $userId,
            'name' => $request->name,
            'effect' => $request->effect,
            'description' => '',
        ]);

        foreach ($request->api_ingredients as $apiId) {
            $recipe->ingredients()->create([
                'api_ingredient_id' => $apiId,
                'quantity' => 1
            ]);
        }

        return redirect()->route('recipes.create')->with('success', '¡Plato cocinado con éxito!');
    }

    public function index()
    {
        $recipes = \App\Models\Recipe::with('ingredients')->latest()->get();

        $apiData = Cache::remember('zelda_materials', 3600, function () {
            $response = Http::get('https://botw-compendium.herokuapp.com/api/v3/compendium/category/materials');
            return $response->json()['data'];
        });

        $materials = collect($apiData)->keyBy('id');

        return view('recipes.index', compact('recipes', 'materials'));
    }
}
