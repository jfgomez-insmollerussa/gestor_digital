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
        // User::factory(10)->create();

        User::query()->firstOrCreate(['email' => 'test@example.com'], [
            'name' => 'Test User',
            'password' => 'password',
        ]);

        $screen = Screen::query()->firstOrCreate(['name' => 'Pantalla principal Edifici H'], [
            'location' => 'Vestíbul Edifici H',
            'manual_slides_position' => 'before',
            'refresh_seconds' => 15,
        ]);

        ManualSlide::query()->firstOrCreate([
            'screen_id' => $screen->id,
            'title' => 'Benvinguts a l\'IES Mollerussa',
        ], [
            'body' => 'Contingut manual de prova per al gestor de Digital Signage.',
            'is_active' => true,
            'is_pinned' => false,
            'sort_order' => 1,
        ]);
    }
}
