@props(['name', 'type' => 'text', 'value' => null])

<input type="{{ $type }}" name="{{ $name }}" id="{{ $attributes->get('id', $name) }}"
       value="{{ old($name, $value) }}"
       @error($name) aria-invalid="true" aria-describedby="{{ $name }}-error" @enderror
       {{ $attributes->except('id')->class([
           'block w-full rounded-lg border bg-white px-3 py-2 text-sm shadow-sm placeholder:text-zinc-400 focus:outline-none focus-visible:ring-2 dark:bg-zinc-900',
           'border-red-500 focus-visible:ring-red-500 dark:border-red-500' => $errors->has($name),
           'border-zinc-300 focus-visible:border-indigo-500 focus-visible:ring-indigo-500 dark:border-zinc-700' => ! $errors->has($name),
       ]) }}>

@error($name)
    <p id="{{ $name }}-error" class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
@enderror
