@csrf

<label for="screen_id">Pantalla</label>
<select id="screen_id" name="screen_id">
    <option value="">Totes les pantalles</option>
    @foreach ($screens as $screen)
        <option value="{{ $screen->id }}" @selected((string) old('screen_id', $manualSlide->screen_id) === (string) $screen->id)>
            {{ $screen->name }}
        </option>
    @endforeach
</select>

<label for="title">Titol</label>
<input id="title" name="title" value="{{ old('title', $manualSlide->title) }}" required>

<label for="body">Text</label>
<textarea id="body" name="body" required>{{ old('body', $manualSlide->body) }}</textarea>

<label for="image_url">URL de la imatge</label>
<input id="image_url" name="image_url" type="url" value="{{ old('image_url', $manualSlide->image_url) }}">

<label for="sort_order">Ordre</label>
<input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $manualSlide->sort_order) }}" required>

<label for="starts_at">Mostrar des de</label>
<input id="starts_at" name="starts_at" type="datetime-local" value="{{ old('starts_at', optional($manualSlide->starts_at)->format('Y-m-d\TH:i')) }}">

<label for="ends_at">Mostrar fins a</label>
<input id="ends_at" name="ends_at" type="datetime-local" value="{{ old('ends_at', optional($manualSlide->ends_at)->format('Y-m-d\TH:i')) }}">

<label>
    <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $manualSlide->is_active))>
    Actiu
</label>

<label>
    <input name="is_pinned" type="checkbox" value="1" @checked(old('is_pinned', $manualSlide->is_pinned))>
    Fixat
</label>

<div class="actions" style="margin-top: 18px;">
    <button type="submit">Desar</button>
    <a class="button secondary" href="{{ route('admin.manual-slides.index') }}">Cancel lar</a>
</div>
