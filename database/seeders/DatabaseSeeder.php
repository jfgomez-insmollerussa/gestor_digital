<?php

namespace Database\Seeders;

use App\Models\ManualSlide;
use App\Models\Screen;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->firstOrCreate(['email' => 'test@example.com'], [
            'name' => 'Test User',
            'password' => 'password',
        ]);

        $mainScreen = Screen::query()->updateOrCreate(['name' => 'Pantalla principal Edifici H'], [
            'location' => 'Vestibul Edifici H',
            'manual_slides_position' => 'before',
            'refresh_seconds' => 15,
            'is_blocked' => false,
            'blocked_message' => 'Fora de servei',
        ]);

        $libraryScreen = Screen::query()->updateOrCreate(['name' => 'Pantalla biblioteca'], [
            'location' => 'Biblioteca',
            'manual_slides_position' => 'after',
            'refresh_seconds' => 20,
            'is_blocked' => false,
            'blocked_message' => 'Fora de servei',
        ]);

        $workshopScreen = Screen::query()->updateOrCreate(['name' => 'Pantalla tallers'], [
            'location' => 'Zona de tallers',
            'manual_slides_position' => 'before',
            'refresh_seconds' => 15,
            'is_blocked' => false,
            'blocked_message' => 'Fora de servei',
        ]);

        ManualSlide::query()->updateOrCreate([
            'screen_id' => $mainScreen->id,
            'title' => 'Benvinguts a l\'IES Mollerussa',
        ], [
            'body' => 'Contingut manual de prova per al gestor de Digital Signage.',
            'is_active' => true,
            'is_pinned' => false,
            'sort_order' => 1,
        ]);

        ManualSlide::query()->updateOrCreate([
            'screen_id' => $mainScreen->id,
            'title' => 'Avis important',
        ], [
            'body' => 'Aquest es un missatge manual creat des del panell d\'administracio.',
            'is_active' => true,
            'is_pinned' => false,
            'sort_order' => 2,
        ]);

        ManualSlide::query()->updateOrCreate([
            'screen_id' => $libraryScreen->id,
            'title' => 'Horari de biblioteca',
        ], [
            'body' => 'La biblioteca esta oberta durant els patis i en les hores indicades pel centre.',
            'is_active' => true,
            'is_pinned' => false,
            'sort_order' => 1,
        ]);

        ManualSlide::query()->updateOrCreate([
            'screen_id' => $workshopScreen->id,
            'title' => 'Recordatori de seguretat',
        ], [
            'body' => 'Cal utilitzar els equips de proteccio individual dins dels tallers.',
            'is_active' => true,
            'is_pinned' => false,
            'sort_order' => 1,
        ]);

        ManualSlide::query()->updateOrCreate([
            'screen_id' => null,
            'title' => 'Informacio general del centre',
        ], [
            'body' => 'Consulta els canals oficials del centre per estar al dia de les novetats.',
            'is_active' => true,
            'is_pinned' => false,
            'sort_order' => 10,
        ]);
    }
}
