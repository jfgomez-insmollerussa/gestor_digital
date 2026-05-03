# Documentacio tecnica M07 - Gestor Digital Signage Edifici H

## 1. Introduccio

Aquest projecte consisteix en adaptar un projecte Laravel existent per convertir-lo en un gestor de Digital Signage per a l'IES Mollerussa, concretament pensat per a les pantalles informatives de l'Edifici H.

L'objectiu principal de la part de M07 es crear la part backend del sistema:

- Un panell d'administracio fet amb Blade.
- Una base de dades per guardar pantalles i continguts manuals.
- Una API REST que retorni el contingut consolidat per a cada pantalla.
- La connexio amb les noticies publiques de la web de l'institut.

El visor final de les pantalles, fet amb HTML, CSS, JavaScript i AJAX, es fara mes endavant al modul M09. Per aquest motiu, en aquesta practica de M07 no s'ha implementat encara el reproductor visual de diapositives.

## 2. Estat inicial del projecte

El projecte no s'ha creat de zero. S'ha reutilitzat el repositori Laravel que ja existia.

Abans de començar es va revisar l'estructura del projecte:

- `composer.json`
- `package.json`
- `.env`
- `routes/web.php`
- `database/migrations`
- `database/seeders`
- `app/Models`
- `app/Http/Controllers`
- `resources/views`

Es va comprovar que el projecte utilitza:

- Laravel 13.5.0.
- PHP 8.3 o superior.
- Base de dades SQLite.
- Fitxer `database/database.sqlite` existent.

Tambee es va comprovar que ja hi havia codi antic de practiques anteriors, com rutes d'articles, calculadora i perfil d'usuari. Aquest codi no s'ha eliminat, per evitar borrar funcionalitats antigues sense necessitat.

## 3. Arquitectura implementada

La practica s'ha separat en dues parts principals dins de M07.

### 3.1 Panell d'administracio

El panell d'administracio esta fet amb:

- Rutes web a `routes/web.php`.
- Controladors normals de Laravel.
- Vistes Blade.
- Formularis HTML.
- Validacio amb Laravel.
- Redireccions despres de crear, editar o eliminar dades.

La part d'administracio no consumeix la API REST. Treballa directament amb els models de Laravel, tal com demana l'enunciat.

### 3.2 API REST

La API REST esta feta amb Laravel i les rutes estan a `routes/api.php`.

La ruta principal es:

```txt
GET /api/screens/{screen}/content
```

Aquesta ruta retorna un JSON amb el contingut que ha de mostrar una pantalla concreta.

La API combina:

- Continguts manuals actius.
- Noticies web de l'IES Mollerussa.
- Configuracio de l'ordre dels continguts.
- Estat de bloqueig de la pantalla.
- Continguts fixats.

La URL externa de noticies utilitzada es:

```txt
https://agora.xtec.cat/ies-mollerussa/wp-json/wp/v2/posts?per_page=5
```

## 4. Estructura de fitxers afegits

S'han afegit els seguents models:

```txt
app/Models/Screen.php
app/Models/ManualSlide.php
```

S'han afegit els seguents controladors:

```txt
app/Http/Controllers/Admin/ScreenController.php
app/Http/Controllers/Admin/ManualSlideController.php
app/Http/Controllers/Api/ScreenContentController.php
```

S'han afegit o modificat les rutes:

```txt
routes/web.php
routes/api.php
bootstrap/app.php
```

S'han creat les vistes Blade del panell:

```txt
resources/views/admin/screens/index.blade.php
resources/views/admin/screens/create.blade.php
resources/views/admin/screens/edit.blade.php
resources/views/admin/screens/_form.blade.php

resources/views/admin/manual-slides/index.blade.php
resources/views/admin/manual-slides/create.blade.php
resources/views/admin/manual-slides/edit.blade.php
resources/views/admin/manual-slides/_form.blade.php
```

Tambee s'ha modificat el layout general:

```txt
resources/views/layouts/app.blade.php
```

## 5. Estructura de la base de dades

S'han creat dues taules noves:

```txt
screens
manual_slides
```

### 5.1 Taula `screens`

Aquesta taula guarda les pantalles que es poden gestionar des del panell.

Camps principals:

| Camp | Descripcio |
| --- | --- |
| `id` | Identificador de la pantalla |
| `name` | Nom de la pantalla |
| `location` | Ubicacio de la pantalla |
| `is_blocked` | Indica si la pantalla esta bloquejada |
| `blocked_message` | Missatge que es mostrara si esta bloquejada |
| `manual_slides_position` | Defineix si els continguts manuals van abans o despres de les noticies |
| `refresh_seconds` | Segons entre canvis de contingut |
| `created_at` / `updated_at` | Dates de creacio i modificacio |

### 5.2 Taula `manual_slides`

Aquesta taula guarda els continguts manuals creats pels administradors.

Camps principals:

| Camp | Descripcio |
| --- | --- |
| `id` | Identificador del contingut |
| `screen_id` | Pantalla associada, pot ser null si es global |
| `title` | Titol del contingut |
| `body` | Text principal |
| `image_url` | URL opcional d'una imatge |
| `is_active` | Indica si el contingut esta actiu |
| `is_pinned` | Indica si el contingut esta fixat |
| `sort_order` | Ordre de visualitzacio |
| `starts_at` | Data opcional d'inici |
| `ends_at` | Data opcional de finalitzacio |
| `created_at` / `updated_at` | Dates de creacio i modificacio |

## 6. Relacions entre models

La relacio principal es:

- Una pantalla pot tenir molts continguts manuals.
- Un contingut manual pot pertanyer a una pantalla.
- Si `screen_id` es null, el contingut es considera global.

Aixo permet tenir continguts especifics per a una pantalla, pero tambe continguts que es poden mostrar a totes.

## 7. Rutes web implementades

Les rutes web del panell son:

```txt
GET    /admin/screens
GET    /admin/screens/create
POST   /admin/screens
GET    /admin/screens/{screen}/edit
PUT    /admin/screens/{screen}
DELETE /admin/screens/{screen}
```

Aquestes rutes serveixen per gestionar pantalles.

Les rutes de continguts manuals son:

```txt
GET    /admin/manual-slides
GET    /admin/manual-slides/create
POST   /admin/manual-slides
GET    /admin/manual-slides/{manual_slide}/edit
PUT    /admin/manual-slides/{manual_slide}
DELETE /admin/manual-slides/{manual_slide}
```

Aquestes rutes serveixen per gestionar els missatges o diapositives manuals.

## 8. Ruta API implementada

La ruta API principal es:

```txt
GET /api/screens/{screen}/content
```

Exemple:

```txt
http://127.0.0.1:8000/api/screens/1/content
```

La resposta es un JSON. Per exemple, si la pantalla esta activa:

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

Si la pantalla esta bloquejada:

```json
{
  "screen": {
    "id": 1,
    "name": "Pantalla principal Edifici H",
    "location": "Vestibul Edifici H",
    "refresh_seconds": 15
  },
  "blocked": true,
  "message": "Fora de servei",
  "items": []
}
```

## 9. Logica aplicada a la API

La API fa les comprovacions en aquest ordre:

1. Busca la pantalla sol.licitada.
2. Si la pantalla esta bloquejada, retorna nomes el missatge de bloqueig.
3. Busca els continguts manuals actius.
4. Si hi ha continguts manuals fixats, retorna nomes aquests.
5. Si no hi ha continguts fixats, consulta les noticies de la web de l'institut.
6. Barreja manuals i noticies segons l'ordre configurat a la pantalla.
7. Retorna el JSON final.

La regla mes important es la dels continguts fixats:

> Si hi ha una entrada manual fixada, nomes es mostren les entrades fixades i s'oculten la resta de manuals i les noticies web.

## 10. Decisions tecniques

### Reutilitzar el projecte existent

No s'ha creat un projecte Laravel nou. S'ha aprofitat el projecte que ja existia i s'han afegit les parts necessaries de forma controlada.

### No borrar el codi antic

El projecte tenia codi de practiques anteriors. Aquest codi no s'ha eliminat per no perdre funcionalitats i per evitar canvis innecessaris.

### Utilitzar SQLite

Com que el projecte ja estava configurat amb SQLite i funcionava correctament, s'ha mantingut aquesta base de dades. Per una practica de DAW es suficient i facilita les proves.

### Separar panell i API

El panell Blade i la API REST estan separats. El panell treballa amb formularis i models, mentre que la API retorna JSON.

Aixo compleix el requisit de l'enunciat, que diu que l'administracio no ha de consumir la API REST.

### Deixar el visor per a M09

El visor de pantalles no s'ha fet en aquesta fase perque forma part de la practica de M09. La API ja esta preparada perque el visor pugui consumir-la amb JavaScript i AJAX.

## 11. Com provar el projecte

Primer cal arrencar el servidor Laravel:

```powershell
& 'C:\xampp\php\php.exe' artisan serve --host=127.0.0.1 --port=8000
```

Despres es pot accedir al panell:

```txt
http://127.0.0.1:8000/admin/screens
```

Per gestionar continguts manuals:

```txt
http://127.0.0.1:8000/admin/manual-slides
```

Per provar la API:

```txt
http://127.0.0.1:8000/api/screens/1/content
```


## 12. Relacio amb M09

La practica de M09 implementara el visor accessible i usable.

Aquest visor haura de consumir la API de M07:

```txt
GET /api/screens/{screen}/content
```

La idea sera crear una interfície amb:

- Text gran i llegible a distancia.
- Bon contrast de colors.
- Distribucio clara.
- Transicions entre continguts.
- Suport per imatges i text.
- Estat especial si la pantalla esta bloquejada.

Per tant, M07 deixa preparada tota la part de dades i M09 s'encarregara de la part visual.

## 13. Conclusio

En aquesta fase s'ha aconseguit adaptar el projecte Laravel existent a un gestor de Digital Signage.

El projecte ja permet gestionar pantalles i continguts manuals des d'un panell Blade, i tambe disposa d'una API REST que retorna el contingut consolidat per a cada pantalla.

No s'ha implementat encara el visor final perque es fara al modul M09, pero la API ja esta preparada per integrar-se amb aquest visor.
