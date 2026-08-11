@props(['type' => 'success'])

@php
    $styles = [
        'success' => 'border-emerald-200 bg-emerald-50 text-emerald-800',
        'info' => 'border-blue-200 bg-blue-50 text-blue-800',
        'error' => 'border-rose-200 bg-rose-50 text-rose-800',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-800',
    ];
    $icons = [
        'success' => '✅',
        'info' => 'ℹ️',
        'error' => '⚠️',
        'warning' => '⚠️',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'mb-4 flex items-start gap-3 rounded-xl border px-4 py-3 text-sm '.$styles[$type]]) }}>
    <span class="mt-0.5">{{ $icons[$type] }}</span>
    <div class="flex-1">{{ $slot }}</div>
</div>
