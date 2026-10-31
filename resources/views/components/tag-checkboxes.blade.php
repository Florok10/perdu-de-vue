@props(['tags', 'selected' => []])

@php
    // After a refused submit, keep exactly what was ticked, even when nothing was.
    $checked = session()->hasOldInput()
        ? array_map('intval', (array) old('tags', []))
        : $selected;
@endphp

<fieldset>
    <legend class="mb-2 text-sm font-medium text-zinc-700 dark:text-zinc-200">Étiquettes</legend>
    <div class="flex flex-wrap gap-2">
        @foreach ($tags as $tag)
            <label class="inline-flex cursor-pointer items-center gap-2 rounded-full border border-zinc-300 bg-white px-3 py-1.5 text-sm hover:border-indigo-400 has-checked:border-indigo-500 has-checked:bg-indigo-50 has-focus-visible:ring-2 has-focus-visible:ring-indigo-500 dark:border-zinc-700 dark:bg-zinc-900 dark:has-checked:bg-indigo-950">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, $checked, true))
                       class="size-4 rounded border-zinc-300 text-indigo-600 accent-indigo-600 focus:outline-none">
                {{ $tag->name }}
            </label>
        @endforeach
    </div>
    @error('tags')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    @error('tags.*')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</fieldset>
