<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Screen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScreenController extends Controller
{
    public function index(): View
    {
        return view('admin.screens.index', [
            'screens' => Screen::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.screens.create', [
            'screen' => new Screen([
                'blocked_message' => 'Fora de servei',
                'manual_slides_position' => 'before',
                'refresh_seconds' => 15,
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Screen::query()->create($this->validatedData($request));

        return redirect()
            ->route('admin.screens.index')
            ->with('status', 'Pantalla creada correctament.');
    }

    public function edit(Screen $screen): View
    {
        return view('admin.screens.edit', ['screen' => $screen]);
    }

    public function update(Request $request, Screen $screen): RedirectResponse
    {
        $screen->update($this->validatedData($request));

        return redirect()
            ->route('admin.screens.index')
            ->with('status', 'Pantalla actualitzada correctament.');
    }

    public function destroy(Screen $screen): RedirectResponse
    {
        $screen->delete();

        return redirect()
            ->route('admin.screens.index')
            ->with('status', 'Pantalla eliminada correctament.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'blocked_message' => ['required', 'string', 'max:255'],
            'manual_slides_position' => ['required', 'in:before,after'],
            'refresh_seconds' => ['required', 'integer', 'min:5', 'max:300'],
            'is_blocked' => ['nullable', 'boolean'],
        ]);

        $data['is_blocked'] = $request->boolean('is_blocked');

        return $data;
    }
}
