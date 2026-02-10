<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class IngredientController extends Controller
{
    public function index()
    {
        // Usamos Cache para no solicitar a la API cada vez que recarguemos
        $materials = Cache::remeber('hyrule_materials', 3600, function() {
        // Pedimos a la API la categoría "materials"
        $response = Http::get('https://botw-compendium.herokuapp.com/api/v3/compendium/category/materials');
        return $response->json()['data'];
        });

        return view('ingredients.index', compact('materials'));
    }
}
