# Gestor Digital Signage - Edifici H

Proyecto Laravel para la practica M07: **Desenvolupament d'un Gestor Digital Signage per a l'Edifici H**.

El objetivo es gestionar pantallas informativas del IES Mollerussa desde un panel de administracion y exponer una API REST con el contenido consolidado que mas adelante consumira el visor de M09.

## Estado del proyecto

Implementado en M07:

- Gestion de pantallas desde Blade.
- Gestion de contenidos manuales desde Blade.
- Configuracion del orden entre contenidos manuales y noticias web.
- Opcion de fijar contenidos manuales.
- Si hay contenidos fijados, la API devuelve solo esos contenidos.
- Bloqueo remoto de pantallas con mensaje tipo `Fora de servei`.
- API REST con contenido consolidado por pantalla.
- Consumo de noticias externas del IES Mollerussa.

Pendiente para M09:

- Visualizador HTML/CSS/JavaScript/AJAX para las pantallas fisicas.
- Slideshow accesible y usable.

## Requisitos

- PHP 8.3 o superior.
- Composer.
- SQLite.
- Node.js solo si se quieren compilar assets con Vite.

El proyecto esta basado en Laravel 13.

## Instalacion

Clonar el repositorio:

```bash
git clone URL_DEL_REPOSITORIO
cd laravel-practica
```

Instalar dependencias PHP:

```bash
composer install
```

Crear el archivo de entorno:

```bash
cp .env.example .env
```

En Windows PowerShell, si `cp` no esta disponible:

```powershell
Copy-Item .env.example .env
```

Generar la clave de Laravel:

```bash
php artisan key:generate
```

Crear la base de datos SQLite local:

```bash
touch database/database.sqlite
```

En Windows PowerShell:

```powershell
New-Item database/database.sqlite -ItemType File
```

Ejecutar migraciones y seeders:

```bash
php artisan migrate --seed
```

> Nota importante: `database/database.sqlite` no se incluye en el repositorio. La base de datos se genera localmente con los comandos anteriores. Asi el proyecto se puede reconstruir siempre desde las migraciones y los seeders.

Resumen rapido para Windows con XAMPP:

```powershell
New-Item database/database.sqlite -ItemType File
& 'C:\xampp\php\php.exe' artisan migrate --seed
```

## Ejecucion

Arrancar el servidor local:

```bash
php artisan serve
```

Con XAMPP en Windows se puede usar:

```powershell
& 'C:\xampp\php\php.exe' artisan serve --host=127.0.0.1 --port=8000
```

Abrir en el navegador:

```txt
http://127.0.0.1:8000
```

## Rutas principales

Panel de pantallas:

```txt
http://127.0.0.1:8000/admin/screens
```

Panel de contenidos manuales:

```txt
http://127.0.0.1:8000/admin/manual-slides
```

API REST de una pantalla:

```txt
http://127.0.0.1:8000/api/screens/1/content
```

## API REST

La API principal es:

```txt
GET /api/screens/{screen}/content
```

Devuelve un JSON con:

- Datos de la pantalla.
- Estado de bloqueo.
- Contenidos manuales activos.
- Noticias web externas.
- Orden configurado.
- Regla de contenidos fijados.

La URL externa utilizada para noticias es:

```txt
https://agora.xtec.cat/ies-mollerussa/wp-json/wp/v2/posts?per_page=5
```

Ejemplo de respuesta:

```json
{
  "screen": {
    "id": 1,
    "name": "Pantalla principal Edifici H",
    "location": "Vestibul Edifici H",
    "refresh_seconds": 15
  },
  "blocked": false,
  "only_pinned": false,
  "manual_slides_position": "before",
  "items": []
}
```

## Base de datos

Tablas principales:

- `screens`
- `manual_slides`

La tabla `screens` guarda las pantallas.

La tabla `manual_slides` guarda los contenidos manuales.

Los contenidos manuales pueden estar asociados a una pantalla concreta o ser globales si `screen_id` es `null`.

## Documentacion tecnica

El documento tecnico de la practica esta en:

```txt
DOCUMENTACION_TECNICA_M07.md
```

Explica:

- Arquitectura del proyecto.
- Estructura de la base de datos.
- Rutas web y API.
- Decisiones tecnicas tomadas.
- Relacion entre M07 y M09.

## Archivos que no se suben

No se suben al repositorio:

- `.env`
- `vendor/`
- `node_modules/`
- `database/database.sqlite`
- `.history/`
- logs y caches locales

Esto evita subir datos locales, dependencias generadas o configuraciones privadas.

## Comprobaciones utiles

Ver rutas:

```bash
php artisan route:list
```

Ver migraciones:

```bash
php artisan migrate:status
```

Compilar vistas Blade:

```bash
php artisan view:cache
php artisan view:clear
```
