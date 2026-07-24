<!doctype html>
<html lang="ar" dir="rtl" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="تسجيل الدخول إلى منصة حوات الحكومية">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تسجيل دخول | منصة حوات</title>
    <link rel="icon" href="{{ asset('images/government/hisbah-logo.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="owner-ui">
    <main class="gov-login-page">
        <section class="gov-login" aria-labelledby="login-title">
            <a class="gov-login__brand" href="{{ route('login') }}" aria-label="حوات">
                <img src="{{ asset('images/government/hisbah-logo.png') }}" alt="حوات">
            </a>

            <div class="gov-login__heading">
                <h1 id="login-title">تسجيل دخول</h1>
                <p>لحمايتك، يرجى التحقق من هويتك!</p>
            </div>

            <form class="gov-login__form" method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="gov-field-group">
                    <label class="gov-label" for="email">البريد الإلكتروني <span class="gov-required">*</span></label>
                    <input class="owner-field" id="email" name="email" type="email"
                        value="{{ old('email', config('government.user.email')) }}" autocomplete="username" required autofocus>
                    @error('email')
                        <p class="gov-login__error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="gov-field-group">
                    <label class="gov-label" for="password">كلمة المرور <span class="gov-required">*</span></label>
                    <input class="owner-field" id="password" name="password" type="password"
                        autocomplete="current-password" required>
                    @error('password')
                        <p class="gov-login__error">{{ $message }}</p>
                    @enderror
                </div>

                <label class="gov-login__remember" for="remember">
                    <input id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))>
                    <span>تذكرني</span>
                </label>

                <button class="owner-button gov-login__submit" type="submit">تسجيل دخول</button>
            </form>

            @env('local')
                <p class="gov-login__note">كلمة مرور النسخة التجريبية: password</p>
            @endenv
        </section>
    </main>
</body>
</html>
