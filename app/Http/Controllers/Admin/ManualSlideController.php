<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManualSlide;
use App\Models\Screen;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManualSlideController extends Controller
{
    public function index(): View
    {
        return view('admin.manual-slides.index', [
            'manualSlides' => ManualSlide::query()
                ->with('screen')
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.manual-slides.create', [
            'manualSlide' => new ManualSlide([
                'is_active' => true,
                'is_pinned' => false,
                'sort_order' => 0,
            ]),
            'screens' => $this->screenOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        ManualSlide::query()->create($this->validatedData($request));

        return redirect()
            ->route('admin.manual-slides.index')
            ->with('status', 'Contingut manual creat correctament.');
    }

    public function edit(ManualSlide $manualSlide): View
    {
        return view('admin.manual-slides.edit', [
            'manualSlide' => $manualSlide,
            'screens' => $this->screenOptions(),
        ]);
    }

    public function update(Request $request, ManualSlide $manualSlide): RedirectResponse
    {
        $manualSlide->update($this->validatedData($request));

        return redirect()
            ->route('admin.manual-slides.index')
            ->with('status', 'Contingut manual actualitzat correctament.');
    }

    public function destroy(ManualSlide $manualSlide): RedirectResponse
    {
        $manualSlide->delete();

        return redirect()
            ->route('admin.manual-slides.index')
            ->with('status', 'Contingut manual eliminat correctament.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'screen_id' => ['nullable', 'exists:screens,id'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'image_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_active' => ['nullable', 'boolean'],
            'is_pinned' => ['nullable', 'boolean'],
        ]);

        $data['screen_id'] = $data['screen_id'] ?: null;
        $data['is_active'] = $request->boolean('is_active');
        $data['is_pinned'] = $request->boolean('is_pinned');

        return $data;
    }

    /**
     * @return Collection<int, Screen>
     */
    private function screenOptions(): Collection
    {
        return Screen::query()->orderBy('name')->get();
    }
}
