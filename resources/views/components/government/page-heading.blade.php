@props([
    'eyebrow',
    'title',
    'description' => null,
])

<div class="owner-page-head">
    <div>
        <p class="owner-page-head__eyebrow">{{ $eyebrow }}</p>
        <h1>{{ $title }}</h1>
        @if ($description)
            <p>{{ $description }}</p>
        @endif
    </div>

    @isset($actions)
        <div class="gov-actions">{{ $actions }}</div>
    @endisset
</div>
