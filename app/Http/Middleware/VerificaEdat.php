<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificaEdat
{
    public function handle(Request $request, Closure $next): Response
    {
        $edat = $request->query('edat');

        if ($edat === null || (int) $edat < 18) {
            abort(403, 'Accés denegat: Ets menor d\'edat');
        }

        return $next($request);
    }
}
