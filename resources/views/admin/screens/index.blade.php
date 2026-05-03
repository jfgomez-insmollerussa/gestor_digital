@extends('layouts.app')

@section('titol', 'Pantalles')

@section('contingut')
    <div class="actions">
        <h2 style="margin-right: auto;">Pantalles</h2>
        <a class="button" href="{{ route('admin.screens.create') }}">Nova pantalla</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Ubicacio</th>
                <th>Ordre</th>
                <th>Estat</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($screens as $screen)
                <tr>
                    <td>{{ $screen->name }}</td>
                    <td>{{ $screen->location ?: '-' }}</td>
                    <td>
                        {{ $screen->manual_slides_position === 'before' ? 'Manuals abans' : 'Manuals despres' }}
                    </td>
                    <td>
                        {{ $screen->is_blocked ? 'Bloquejada' : 'Activa' }}
                    </td>
                    <td>
                        <div class="actions">
                            <a class="button secondary" href="{{ route('admin.screens.edit', $screen) }}">Editar</a>
                            <form method="POST" action="{{ route('admin.screens.destroy', $screen) }}">
                                @csrf
                                @method('DELETE')
                                <button class="danger" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Encara no hi ha pantalles creades.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
