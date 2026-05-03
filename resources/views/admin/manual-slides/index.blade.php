@extends('layouts.app')

@section('titol', 'Continguts manuals')

@section('contingut')
    <div class="actions">
        <h2 style="margin-right: auto;">Continguts manuals</h2>
        <a class="button" href="{{ route('admin.manual-slides.create') }}">Nou contingut</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Titol</th>
                <th>Pantalla</th>
                <th>Estat</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($manualSlides as $manualSlide)
                <tr>
                    <td>{{ $manualSlide->sort_order }}</td>
                    <td>
                        <strong>{{ $manualSlide->title }}</strong>
                        <p class="muted">{{ \Illuminate\Support\Str::limit($manualSlide->body, 90) }}</p>
                    </td>
                    <td>{{ $manualSlide->screen?->name ?: 'Totes' }}</td>
                    <td>
                        {{ $manualSlide->is_active ? 'Actiu' : 'Inactiu' }}
                        @if ($manualSlide->is_pinned)
                            <br><strong>Fixat</strong>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a class="button secondary" href="{{ route('admin.manual-slides.edit', $manualSlide) }}">Editar</a>
                            <form method="POST" action="{{ route('admin.manual-slides.destroy', $manualSlide) }}">
                                @csrf
                                @method('DELETE')
                                <button class="danger" type="submit">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Encara no hi ha continguts manuals.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
