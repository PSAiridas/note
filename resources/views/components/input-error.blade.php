@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <li>{{ $message }}</li>
    @endforeach
@endif
