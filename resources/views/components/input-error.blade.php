@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm font-medium text-rose-300']) }}>
        {{ $message }}
    </p>
@enderror
