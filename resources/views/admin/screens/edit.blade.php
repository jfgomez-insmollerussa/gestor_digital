@extends('layouts.app')

@section('titol', 'Editar pantalla')

@section('contingut')
    <h2>Editar pantalla</h2>

    <form method="POST" action="{{ route('admin.screens.update', $screen) }}">
        @method('PUT')
        @include('admin.screens._form')
    </form>
@endsection
