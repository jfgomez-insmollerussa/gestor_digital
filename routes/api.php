<?php

use App\Http\Controllers\Api\ScreenContentController;
use Illuminate\Support\Facades\Route;

Route::get('/screens/{screen}/content', [ScreenContentController::class, 'show'])
    ->name('api.screens.content');
