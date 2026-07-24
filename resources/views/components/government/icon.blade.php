@props(['name'])

<svg {{ $attributes->merge([
    'viewBox' => '0 0 24 24',
    'fill' => 'none',
    'stroke' => 'currentColor',
    'stroke-width' => '1.8',
    'stroke-linecap' => 'round',
    'stroke-linejoin' => 'round',
    'aria-hidden' => 'true',
]) }}>
    @switch($name)
        @case('menu')
            <path d="M4 6h16M4 12h16M4 18h16" />
            @break
        @case('moon')
            <path d="M20.3 15.6A8.5 8.5 0 1 1 8.4 3.7a6.7 6.7 0 0 0 11.9 11.9Z" />
            @break
        @case('sun')
            <circle cx="12" cy="12" r="4" />
            <path d="M12 2v2M12 20v2M4.93 4.93l1.42 1.42M17.65 17.65l1.42 1.42M2 12h2M20 12h2M4.93 19.07l1.42-1.42M17.65 6.35l1.42-1.42" />
            @break
        @case('language')
            <path d="M4 5h8M8 3v2c0 4-2 7-5 9M5 9c1.5 2.3 3.5 4 6 5M14 19l3-8 3 8M15 16h4" />
            @break
        @case('logout')
            <path d="M9 4H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h4M16 17l5-5-5-5M21 12H9" />
            @break
        @case('dashboard')
            <rect x="3" y="3" width="7" height="7" />
            <rect x="14" y="3" width="7" height="7" />
            <rect x="3" y="14" width="7" height="7" />
            <rect x="14" y="14" width="7" height="7" />
            @break
        @case('chart')
            <path d="M4 19V9m5 10V5m5 14v-7m5 7V3" />
            @break
        @case('production')
            <path d="M4 12c3-5 8-7 14-4l3-2-1 5 1 5-3-2c-6 3-11 1-14-4Z" />
            <circle cx="15" cy="10" r=".8" fill="currentColor" stroke="none" />
            @break
        @case('calendar')
            <rect x="3" y="5" width="18" height="16" />
            <path d="M16 3v4M8 3v4M3 10h18M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01" />
            @break
        @case('fish')
            <path d="M4 12c3-5 8-7 14-4l3-2-1 5 1 5-3-2c-6 3-11 1-14-4ZM6 12H3" />
            <circle cx="15" cy="10" r=".7" fill="currentColor" stroke="none" />
            @break
        @case('users')
            <circle cx="9" cy="8" r="3" />
            <circle cx="17" cy="9" r="2" />
            <path d="M3.5 19c.4-3.6 2.2-5.5 5.5-5.5s5.1 1.9 5.5 5.5M14 14c3.5-.5 5.6 1.2 6 4" />
            @break
        @case('tools')
            <path d="M14.7 6.3a4 4 0 0 0-5-5l2.1 2.1-2.4 2.4-2.1-2.1a4 4 0 0 0 5 5L19 15.4a2.1 2.1 0 1 1-3 3l-6.7-6.7a4 4 0 0 0-5 5l2.1-2.1 2.4 2.4-2.1 2.1a4 4 0 0 0 5-5" />
            @break
        @case('report')
            <path d="M6 2h9l4 4v16H6zM14 2v5h5M9 17v-3M12 17v-6M15 17v-8" />
            @break
        @case('warning')
            <path d="M12 3 2.5 20h19L12 3Z" />
            <path d="M12 9v5M12 17h.01" />
            @break
        @case('port')
            <path d="M3 16.5 12 20l9-3.5M5 15V9l7-4 7 4v6M9 12h6" />
            @break
        @case('employee')
            <circle cx="12" cy="7" r="3" />
            <path d="M5 21c.4-5 2.7-7.5 7-7.5s6.6 2.5 7 7.5M16 4h4M18 2v4" />
            @break
        @case('permissions')
            <rect x="3" y="3" width="6" height="6" />
            <rect x="15" y="3" width="6" height="6" />
            <rect x="3" y="15" width="6" height="6" />
            <path d="M15 18h6M18 15v6" />
            @break
        @case('refresh')
            <path d="M20 6v5h-5M4 18v-5h5" />
            <path d="M6.1 9A7 7 0 0 1 18.5 6.5L20 11M4 13l1.5 4.5A7 7 0 0 0 18 15" />
            @break
        @case('plus')
            <path d="M12 5v14M5 12h14" />
            @break
        @case('print')
            <path d="M6 9V3h12v6M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v7H6z" />
            @break
        @case('search')
            <circle cx="11" cy="11" r="7" />
            <path d="m20 20-4-4" />
            @break
        @case('reset')
            <path d="M3 12a9 9 0 1 0 3-6.7L3 8M3 3v5h5" />
            @break
        @case('speed')
            <path d="M5.6 19a9 9 0 1 1 12.8 0M12 13l4-4" />
            <path d="M4 14h2M18 14h2M6.5 8.5l1.4 1.4M16.1 9.9l1.4-1.4M12 5v2" />
            @break
        @case('boat')
            <path d="M3 17c2 0 2 1.5 4 1.5s2-1.5 4-1.5 2 1.5 4 1.5 2-1.5 4-1.5 2 1.5 3 1.5M5 14h14l-2 3H7l-2-3ZM8 14V8h7l3 6M11 8V5h4v3" />
            @break
        @case('sales')
            <path d="M5 19V5m0 14h14M8 15l3-4 3 2 5-7" />
            @break
        @case('percentage')
            <path d="M7 17 17 7" />
            <circle cx="7" cy="7" r="2" />
            <circle cx="17" cy="17" r="2" />
            @break
        @case('licenses')
            <rect x="4" y="3" width="16" height="18" />
            <path d="M8 8h8M8 12h8M8 16h5" />
            @break
        @case('list')
            <path d="M9 6h11M9 12h11M9 18h11M4 6h.01M4 12h.01M4 18h.01" />
            @break
        @case('globe')
            <circle cx="12" cy="12" r="9" />
            <path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18" />
            @break
        @case('governorates')
            <rect x="4" y="3" width="16" height="18" />
            <path d="M8 7h2M14 7h2M8 11h2M14 11h2M8 15h2M14 15h2M10 21v-3h4v3" />
            @break
        @case('weight')
            <path d="M5 21h14l-1.5-12h-11L5 21ZM9 9a3 3 0 0 1 6 0M12 13v3" />
            @break
        @case('species')
            <circle cx="12" cy="5" r="2" />
            <circle cx="6" cy="17" r="2" />
            <circle cx="18" cy="17" r="2" />
            <path d="M12 7v4M6 15v-2h12v2" />
            @break
        @case('export')
            <path d="M12 3v12M7 8l5-5 5 5M5 14v6h14v-6" />
            @break
        @case('money')
            <rect x="3" y="5" width="18" height="14" />
            <circle cx="12" cy="12" r="3" />
            <path d="M7 8H5v2M17 16h2v-2" />
            @break
        @case('saudi')
            <path d="M5 21V4M5 5h13l-2 4 2 4H5" />
            @break
        @case('foreign')
            <circle cx="12" cy="12" r="9" />
            <path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18" />
            @break
        @case('id-card')
            <rect x="3" y="5" width="18" height="14" />
            <circle cx="8" cy="11" r="2" />
            <path d="M5.5 16c.3-2 1.1-3 2.5-3s2.2 1 2.5 3M13 10h5M13 14h4" />
            @break
        @case('back')
            <path d="m15 18-6-6 6-6" />
            @break
        @case('save')
            <path d="M4 4h14l2 2v14H4zM8 4v6h8V4M8 20v-6h8v6" />
            @break
        @case('close')
            <path d="M6 6l12 12M18 6 6 18" />
            @break
        @case('empty')
            <path d="M4 6h16v14H4zM8 3h8v3M8 11h8M8 15h5" />
            @break
        @default
            <circle cx="12" cy="12" r="9" />
    @endswitch
</svg>
