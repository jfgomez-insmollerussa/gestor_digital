@extends('layouts.app')

@section('titol', 'Nova pantalla')

@section('contingut')
    <h2>Nova pantalla</h2>

    <form method="POST" action="{{ route('admin.screens.store') }}">
        @include('admin.screens._form')
    </form>
@endsection
