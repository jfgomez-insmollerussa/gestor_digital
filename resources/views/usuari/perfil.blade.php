@extends('layouts.app')

@section('titol', 'Perfil de l\'usuari')

@section('contingut')
    <h2>Perfil de l'usuari</h2>

    <table>
        <tr>
            <th>Camp</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>Nom</td>
            <td>{{ $usuari['nom'] }}</td>
        </tr>
        <tr>
            <td>Cognom</td>
            <td>{{ $usuari['cognom'] }}</td>
        </tr>
        <tr>
            <td>Curs</td>
            <td>{{ $usuari['curs'] }}</td>
        </tr>
    </table>
@endsection
