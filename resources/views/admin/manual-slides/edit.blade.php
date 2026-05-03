@extends('layouts.app')

@section('titol', 'Editar contingut manual')

@section('contingut')
    <h2>Editar contingut manual</h2>

    <form method="POST" action="{{ route('admin.manual-slides.update', $manualSlide) }}">
        @method('PUT')
        @include('admin.manual-slides._form')
    </form>
@endsection
