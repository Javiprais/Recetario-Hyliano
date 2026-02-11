<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Recetas - Recetario Hyliano</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        <h1>📖 Mis Recetas Guardadas</h1>
        <p>Tu historial de cocina</p>
    </header>

    <div class="container">
        
        <a href="{{ route('recipes.create') }}" class="btn-new">Crear Nueva Receta</a>

        @if($recipes->isEmpty())
            <p>Aún no has cocinado nada. Ve a la alforja y crea tu primer plato.</p>
        @else
            @foreach($recipes as $recipe)
                <div class="recipe-card">
                    <h2 class="recipe-title">{{ $recipe->name }}</h2>
                    <p><strong>Efecto:</strong> {{ ucfirst($recipe->effect) }}</p>
                    <p><strong>Fecha:</strong> {{ $recipe->created_at->format('d/m/Y') }}</p>
                    
                    <h3>Ingredientes utilizados:</h3>
                    <div class="mini-ingredients">
                        @foreach($recipe->ingredients as $pivot)
                            
                            @php
                                $apiInfo = $materials->get($pivot->api_ingredient_id);
                            @endphp

                            @if($apiInfo)
                                <div class="mini-ingredient">
                                    <img src="{{ $apiInfo['image'] }}" alt="{{ $apiInfo['name'] }}">
                                    <br>
                                    {{ ucfirst($apiInfo['name']) }}
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif

    </div>

</body>
</html>