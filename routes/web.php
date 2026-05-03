<?php

use App\Http\Controllers\Admin\ManualSlideController;
use App\Http\Controllers\Admin\ScreenController;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\DadesController;
use App\Http\Middleware\VerificaEdat;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inici');
})->name('inici');

Route::get('/ping', [DadesController::class, 'ping'])->name('ping');

Route::get('/usuari/perfil', [DadesController::class, 'perfil'])->name('usuari.perfil');

Route::get('/calcula/{tipus}/{a}/{b}', [CalculadoraController::class, 'operar'])->name('calculadora.operar');

Route::get('/zona-vip', function () {
    return 'Benvingut a la zona VIP, tens permís per estar aquí!';
})->middleware(VerificaEdat::class)->name('zona.vip');

Route::prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::resource('screens', ScreenController::class)->except(['show']);
        Route::resource('manual-slides', ManualSlideController::class)->except(['show']);
    });
