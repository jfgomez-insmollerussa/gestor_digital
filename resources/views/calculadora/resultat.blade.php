@extends('layouts.app')

@section('titol', 'Resultat de la calculadora')

@section('contingut')
    <h2>Calculadora</h2>

    <p>
        El resultat de la {{ $tipus }} és:

        @if ($valorResultat > 0)
            <span style="color: green; font-weight: bold;">{{ $resultat }}</span>
        @elseif ($valorResultat == 0)
            <span style="color: gray; font-weight: bold;">{{ $resultat }}</span>
        @else
            <span style="color: red; font-weight: bold;">{{ $resultat }}</span>
        @endif
    </p>
@endsection
