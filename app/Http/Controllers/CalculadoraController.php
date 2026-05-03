<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class CalculadoraController extends Controller
{
    public function operar(string $tipus, string $a, string $b): View
    {
        $primer = (float) $a;
        $segon = (float) $b;

        switch ($tipus) {
            case 'suma':
                $resultat = $primer + $segon;
                break;

            case 'resta':
                $resultat = $primer - $segon;
                break;

            default:
                $tipus = 'operació no vàlida';
                $resultat = 0;
                break;
        }

        return view('calculadora.resultat', [
            'tipus' => $tipus,
            'resultat' => $this->formatResultat($resultat),
            'valorResultat' => $resultat,
        ]);
    }

    private function formatResultat(float $resultat): string
    {
        if ((int) $resultat == $resultat) {
            return (string) (int) $resultat;
        }

        return (string) $resultat;
    }
}
