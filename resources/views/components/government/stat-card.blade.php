@props([
    'label',
    'value',
    'icon',
    'meta' => null,
])

<article {{ $attributes->class(['owner-stat-card']) }}>
    <div class="owner-stat-card__top">
        <div>
            <div class="owner-stat-card__label">{{ $label }}</div>
            <div class="owner-stat-card__value">{{ $value }}</div>
        </div>
        <span class="owner-icon-box"><x-government.icon :name="$icon" /></span>
    </div>
    @if ($meta)
        <div class="owner-stat-card__meta">{{ $meta }}</div>
    @endif
</article>
