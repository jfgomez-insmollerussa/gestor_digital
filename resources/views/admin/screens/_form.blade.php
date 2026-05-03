@csrf

<label for="name">Nom</label>
<input id="name" name="name" value="{{ old('name', $screen->name) }}" required>

<label for="location">Ubicacio</label>
<input id="location" name="location" value="{{ old('location', $screen->location) }}">

<label for="manual_slides_position">Ordre dels continguts manuals</label>
<select id="manual_slides_position" name="manual_slides_position" required>
    <option value="before" @selected(old('manual_slides_position', $screen->manual_slides_position) === 'before')>
        Abans de les noticies web
    </option>
    <option value="after" @selected(old('manual_slides_position', $screen->manual_slides_position) === 'after')>
        Despres de les noticies web
    </option>
</select>

<label for="refresh_seconds">Segons entre diapositives</label>
<input id="refresh_seconds" name="refresh_seconds" type="number" min="5" max="300" value="{{ old('refresh_seconds', $screen->refresh_seconds) }}" required>

<label for="blocked_message">Missatge de bloqueig</label>
<input id="blocked_message" name="blocked_message" value="{{ old('blocked_message', $screen->blocked_message) }}" required>

<label>
    <input name="is_blocked" type="checkbox" value="1" @checked(old('is_blocked', $screen->is_blocked))>
    Pantalla bloquejada
</label>

<div class="actions" style="margin-top: 18px;">
    <button type="submit">Desar</button>
    <a class="button secondary" href="{{ route('admin.screens.index') }}">Cancel lar</a>
</div>
