@extends('layouts.app')

@section('titol', 'Nou contingut manual')

@section('contingut')
    <h2>Nou contingut manual</h2>

    <form method="POST" action="{{ route('admin.manual-slides.store') }}">
        @include('admin.manual-slides._form')
    </form>
@endsection
