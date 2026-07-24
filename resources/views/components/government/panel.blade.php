@props([
    'title' => null,
    'badge' => null,
])

<section {{ $attributes->class(['owner-card']) }}>
    @if ($title || $badge || isset($headerActions))
        <header class="owner-card__header">
            @if ($title)
                <h2>{{ $title }}</h2>
            @endif
            @if ($badge)
                <span class="owner-badge">{{ $badge }}</span>
            @endif
            @isset($headerActions)
                <div class="gov-actions">{{ $headerActions }}</div>
            @endisset
        </header>
    @endif

    {{ $slot }}
</section>
