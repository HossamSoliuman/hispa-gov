@props(['title'])

<!doctype html>
<html lang="ar" dir="rtl" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="منصة حوات للرقابة والإشراف على عمليات الصيد البحري">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | منصة حوات</title>
    <link rel="icon" href="{{ asset('images/government/hisbah-logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="owner-ui" data-sidebar-open="false">
    <header class="owner-header">
        <div class="owner-header__start">
            <button class="owner-icon-button" type="button" data-sidebar-toggle aria-label="فتح القائمة">
                <x-government.icon name="menu" />
            </button>
        </div>

        <a class="owner-brand" href="{{ route('government.dashboard') }}" aria-label="حوات - لوحة التحكم">
            <img src="{{ asset('images/government/hisbah-logo.png') }}" alt="حوات">
        </a>

        <div class="owner-header__actions">
            <button class="owner-icon-button" type="button" data-theme-toggle aria-label="تفعيل الوضع الفاتح">
                <x-government.icon class="owner-theme-icon--moon" name="moon" />
                <x-government.icon class="owner-theme-icon--sun" name="sun" />
            </button>
            <span class="gov-header-language" title="الواجهة العربية">
                <x-government.icon name="language" />
                <span>العربية</span>
            </span>
            <span class="owner-user-name">{{ auth()->user()->name }}</span>
            <span class="owner-avatar" aria-hidden="true">H</span>
            <form class="gov-logout-form" method="POST" action="{{ route('government.logout') }}">
                @csrf
                <button class="owner-icon-button" type="submit" aria-label="تسجيل الخروج" title="تسجيل الخروج">
                    <x-government.icon name="logout" />
                </button>
            </form>
        </div>
    </header>

    <aside class="owner-sidebar" aria-label="التنقل الرئيسي">
        <div class="owner-sidebar__eyebrow">لوحة التحكم الحكومية</div>
        <nav class="owner-nav">
            @foreach (config('government.navigation') as $item)
                @if ($item['route'])
                    <a class="owner-nav__link" href="{{ route($item['route']) }}"
                        @if (request()->routeIs($item['active'])) aria-current="page" @endif>
                        <span class="owner-nav__icon"><x-government.icon :name="$item['icon']" /></span>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @else
                    <span class="owner-nav__link gov-nav-link--disabled" aria-disabled="true" title="سيتم توفيره في مرحلة لاحقة">
                        <span class="owner-nav__icon"><x-government.icon :name="$item['icon']" /></span>
                        <span>{{ $item['label'] }}</span>
                    </span>
                @endif
            @endforeach
        </nav>
    </aside>

    <button class="owner-sidebar-backdrop" type="button" data-sidebar-toggle aria-label="إغلاق القائمة"></button>

    <main class="owner-content">
        <div class="gov-content-shell">
            @if (session('status'))
                <div class="gov-flash" role="status" data-dismissible>
                    <span>{{ session('status') }}</span>
                    <button class="gov-flash__close" type="button" data-dismiss aria-label="إغلاق">×</button>
                </div>
            @endif

            {{ $slot }}

            <footer class="gov-footer">© 2026 منصة حوات. جميع الحقوق محفوظة.</footer>
        </div>
    </main>
</body>
</html>
