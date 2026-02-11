# El Recetario Hyliano

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![API](https://img.shields.io/badge/API-REST-brightgreen?style=for-the-badge)

Una aplicación web desarrollada en **Laravel** que actúa como un gestor de cocina para *The Legend of Zelda: Breath of the Wild*. Permite a los usuarios crear, guardar y consultar sus recetas personalizadas combinando datos de una base de datos local (MySQL) con información en tiempo real de una API externa.

## 🎯 Objetivo del Proyecto

En el juego original, no existe un registro persistente de las recetas que el jugador descubre al mezclar ingredientes en las marmitas. Esta aplicación resuelve ese problema permitiendo guardar "fórmulas" exitosas. 

Este proyecto fue desarrollado como práctica académica para demostrar competencias en:
- Consumo de APIs RESTful externas.
- Arquitectura MVC (Model-View-Controller).
- Relaciones de Bases de Datos (1:N y tablas pivote).
- Optimización de consultas usando Caché en Laravel.

## ✨ Características Principales

- **Consumo de API en Tiempo Real:** Obtiene la lista actualizada de materiales e ingredientes desde la [Hyrule Compendium API](https://botw-compendium.herokuapp.com/).
- **Almacenamiento Híbrido:** Las recetas (nombre, efecto) se guardan en la base de datos local, pero los ingredientes solo guardan una referencia (ID) que se cruza dinámicamente con la API al mostrarse.
- **Optimización con Caché:** Las peticiones a la API externa se almacenan en la caché de Laravel (60 minutos) para garantizar tiempos de carga casi instantáneos y no saturar el servidor externo.
- **Validación de Formularios:** Seguridad y validación en el lado del servidor para garantizar que las recetas tengan el formato correcto (máximo 5 ingredientes).

## 📸 Capturas de Pantalla

*(Añade aquí pantallazos de tu aplicación)*

| Creador de Recetas | Mis Recetas Guardadas |
| :---: | :---: |
| ![Crear Receta]([temp]) | ![Listado Recetas]([temp]) |

## 🚀 Instalación y Despliegue Local

Si deseas clonar y probar este proyecto en tu máquina local, sigue estos pasos:

**1. Clona el repositorio:**
```bash
git clone [https://github.com/TU_USUARIO/TU_REPOSITORIO.git](https://github.com/TU_USUARIO/TU_REPOSITORIO.git)
cd TU_REPOSITORIO
```
**2. Instala las dependencias de PHP:**
```bash
composer install
```
**3. Configura el entorno: Copia el archivo de ejemplo y genera la clave de la aplicación.**
```bash
cp .env.example .env
php artisan key:generate
```
**4. Configura la Base de Datos: Abre el archivo .env y configura tus credenciales de MySQL (normalmente en local):**
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=root
DB_PASSWORD=
```
**5. Ejecuta las migraciones:**
```bash
php artisan migrate
```
**6. Crea un usuario de prueba (Requisito para guardar recetas): Abre Tinker en la terminal y ejecuta la factoría de usuarios:**
```bash
php artisan tinker
> App\Models\User::factory()->create();
> exit
```
**7. Levanta el servidor local:**
```bash
php artisan serve
```
La aplicación estará disponible en http://127.0.0.1:8000/recetas

## 🛠️ Tecnologías y Recursos Utilizados
- Backend: Laravel 10/11 (PHP)
- Base de Datos: MySQL
- Frontend: Blade Templating Engine, CSS3 puro.
- API Externa: [Hyrule Compendium API](https://botw-compendium.herokuapp.com/) by gadhagod
