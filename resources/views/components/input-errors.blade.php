@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-black']) }}>{{ $message }}</p>
@enderror