<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DadesController extends Controller
{
    public function ping(): string
    {
        return 'pong';
    }

    public function perfil(): View
    {
        $dadesUsuari = [
            'nom' => 'Laia',
            'cognom' => 'Marti',
            'curs' => '2n DAW',
        ];

        return view('usuari.perfil', ['usuari' => $dadesUsuari]);
    }
}
