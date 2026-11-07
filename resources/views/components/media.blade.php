@php($path = $path ?? null)
@if($path)
    <img src="{{ str_starts_with($path, 'assets/') ? asset($path) : \Illuminate\Support\Facades\Storage::disk('public')->url($path) }}" alt="{{ $alt ?? '' }}" @if(!empty($class)) class="{{ $class }}" @endif loading="{{ $loading ?? 'lazy' }}" decoding="async">
@endif
