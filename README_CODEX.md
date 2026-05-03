# README_CODEX.md — Proyecto M07 Digital Signage Edifici H

## 1. Objetivo del proyecto

Este proyecto consiste en desarrollar un sistema de cartelería digital para gestionar y visualizar el contenido de las pantallas informativas del IES Mollerussa.

El sistema debe permitir:

- Gestionar contenidos manuales desde un panel de administración.
- Consumir automáticamente las últimas noticias de la web del instituto.
- Mostrar una presentación tipo slideshow en las pantallas.
- Gestionar varias pantallas.
- Bloquear pantallas de forma remota.
- Fijar entradas manuales para que solo se muestre ese contenido.

El proyecto debe desarrollarse en Laravel, respetando la separación entre:

1. Panel de administración con Blade.
2. API REST en Laravel.
3. Visualizador de pantallas con HTML, JavaScript y AJAX.

---

## 2. Fuente oficial del enunciado

El proyecto debe cumplir el enunciado:

`E1 - Desenvolupament d'un Gestor Digital Signage per a l'Edifici H`

Requisitos principales del enunciado:

- Laravel es obligatorio.
- El panel de administración debe hacerse con Blade y controladores tradicionales.
- La parte de administración NO debe usar la API REST.
- La API REST debe devolver la información consolidada para cada pantalla.
- El visualizador debe ser HTML + JavaScript + AJAX.
- El visualizador debe consumir la API REST.
- Se deben consumir las últimas noticias de la web del instituto en formato JSON.
- Se deben gestionar contenidos manuales.
- Se debe poder cambiar el orden entre contenidos manuales y noticias automáticas.
- Se debe poder fijar una o varias entradas manuales.
- Si hay entradas fijadas, solo se muestran esas.
- Se deben gestionar múltiples pantallas.
- Se debe poder bloquear una pantalla.

URL externa obligatoria:

```txt
https://agora.xtec.cat/ies-mollerussa/wp-json/wp/v2/posts?per_page=5