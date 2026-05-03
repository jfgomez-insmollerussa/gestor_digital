<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ManualSlide;
use App\Models\Screen;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class ScreenContentController extends Controller
{
    private const NEWS_URL = 'https://agora.xtec.cat/ies-mollerussa/wp-json/wp/v2/posts?per_page=5';

    public function show(Screen $screen): JsonResponse
    {
        if ($screen->is_blocked) {
            return response()->json([
                'screen' => $this->screenData($screen),
                'blocked' => true,
                'message' => $screen->blocked_message,
                'items' => [],
            ]);
        }

        $manualSlides = $this->manualSlidesFor($screen);
        $pinnedSlides = $manualSlides->where('is_pinned', true)->values();

        if ($pinnedSlides->isNotEmpty()) {
            return response()->json([
                'screen' => $this->screenData($screen),
                'blocked' => false,
                'only_pinned' => true,
                'items' => $pinnedSlides->map(fn (ManualSlide $slide): array => $this->manualSlideData($slide))->values(),
            ]);
        }

        $manualItems = $manualSlides
            ->map(fn (ManualSlide $slide): array => $this->manualSlideData($slide))
            ->values()
            ->all();

        $newsItems = $this->newsItems();
        $items = $screen->manual_slides_position === 'after'
            ? [...$newsItems, ...$manualItems]
            : [...$manualItems, ...$newsItems];

        return response()->json([
            'screen' => $this->screenData($screen),
            'blocked' => false,
            'only_pinned' => false,
            'manual_slides_position' => $screen->manual_slides_position,
            'items' => $items,
        ]);
    }

    private function manualSlidesFor(Screen $screen)
    {
        return ManualSlide::query()
            ->active()
            ->where(function ($query) use ($screen): void {
                $query->whereNull('screen_id')->orWhere('screen_id', $screen->id);
            })
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    /**
     * @return array<string, mixed>
     */
    private function screenData(Screen $screen): array
    {
        return [
            'id' => $screen->id,
            'name' => $screen->name,
            'location' => $screen->location,
            'refresh_seconds' => $screen->refresh_seconds,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function manualSlideData(ManualSlide $slide): array
    {
        return [
            'type' => 'manual',
            'id' => $slide->id,
            'title' => $slide->title,
            'body' => $slide->body,
            'image_url' => $slide->image_url,
            'is_pinned' => $slide->is_pinned,
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function newsItems(): array
    {
        try {
            $posts = Http::withoutVerifying()
                ->timeout(5)
                ->acceptJson()
                ->get(self::NEWS_URL)
                ->json();
        } catch (ConnectionException|Throwable) {
            return [];
        }

        if (! is_array($posts)) {
            return [];
        }

        return collect($posts)
            ->filter(fn ($post): bool => is_array($post))
            ->map(function (array $post): array {
                $title = data_get($post, 'title.rendered', '');
                $excerpt = data_get($post, 'excerpt.rendered', '');

                return [
                    'type' => 'news',
                    'id' => data_get($post, 'id'),
                    'title' => $this->plainText($title),
                    'body' => $this->plainText($excerpt),
                    'url' => data_get($post, 'link'),
                    'published_at' => data_get($post, 'date'),
                ];
            })
            ->values()
            ->all();
    }

    private function plainText(mixed $value): string
    {
        $text = html_entity_decode((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return Str::of($text)
            ->replace('&nbsp;', ' ')
            ->stripTags()
            ->squish()
            ->toString();
    }
}
