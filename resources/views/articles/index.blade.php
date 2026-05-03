@extends('layouts.app')

@section('titol', 'Llistat d\'articles')

@section('contingut')
    <h2>Llistat d'articles</h2>

    @forelse ($articles as $article)
        <div style="border: 1px solid #ccc; margin-bottom: 16px; padding: 16px;">
            <strong>{{ $article['titol'] }}</strong>
            <p>Autor: {{ $article['autor'] }}</p>
            <p>Data: {{ $article['data'] }}</p>
        </div>
    @empty
        <p>Actualment no hi ha articles disponibles.</p>
    @endforelse
@endsection
