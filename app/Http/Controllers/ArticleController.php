<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = [
            [
                'titol' => 'Introducció a Laravel',
                'autor' => 'Laia Martí',
                'data' => '21/04/2026',
            ],
            [
                'titol' => 'Com funcionen les vistes Blade',
                'autor' => 'Marc Soler',
                'data' => '22/04/2026',
            ],
            [
                'titol' => 'Rutes i controladors en Laravel',
                'autor' => 'Núria Vidal',
                'data' => '23/04/2026',
            ],
        ];

        return view('articles.index', ['articles' => $articles]);
    }

    public function create(): string
    {
        return 'Formulari de creació d\'article';
    }

    public function store(Request $request): string
    {
        return 'Article desat correctament';
    }

    public function show(string $id): string
    {
        return 'Estàs veient el detall de l\'article amb ID: '.$id;
    }

    public function edit(string $id): string
    {
        return 'Formulari d\'edició de l\'article amb ID: '.$id;
    }

    public function update(Request $request, string $id): string
    {
        return 'Article amb ID '.$id.' actualitzat correctament';
    }

    public function destroy(string $id): string
    {
        return 'Article amb ID '.$id.' eliminat correctament';
    }
}
