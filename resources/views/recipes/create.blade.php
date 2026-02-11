<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Receta - Recetario Hyliano</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header>
        <h1>#LOGO El Recetario Hyliano</h1>
        <p>Selecciona ingredientes de la alforja y crea tu plato</p>
    </header>
    @if (session('success'))
        <div
            style="background-color: #d4edda; color: #155724; padding: 15px; text-align: center; margin-bottom: 20px; border-bottom: 2px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div
            style="background-color: #f8d7da; color: #721c24; padding: 15px; text-align: center; margin-bottom: 20px; border-bottom: 2px solid #f5c6cb;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form action="{{ route('recipes.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="name">Nombre del Plato:</label>
                <input type="text" id="name" name="name" placeholder="Ej: Brocheta de setas" required>
            </div>

            <div class="form-group">
                <label for="effect">Efecto Especial:</label>
                <select id="effect" name="effect">
                    <option value="none">Ninguno (Solo recupera corazones)</option>
                    <option value="stamina">Vigor (Recupera resistencia)</option>
                    <option value="cold_resist">Resistencia al frío</option>
                    <option value="heat_resist">Resistencia al calor</option>
                    <option value="attack_up">Ataque extra</option>
                </select>
            </div>

            <label>Elige tus ingredientes (Marca las casillas):</label>

            <div class="ingredients-grid">
                @foreach ($ingredients as $ingredient)
                    <div class="ingredient-card">
                        <img src="{{ $ingredient['image'] }}" alt="{{ $ingredient['name'] }}">
                        <p>{{ ucfirst($ingredient['name']) }}</p>

                        <input type="checkbox" name="api_ingredients[]" value="{{ $ingredient['id'] }}">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn-submit">¡Cocinar Plato!</button>
        </form>
    </div>

</body>

</html>
