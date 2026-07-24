<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\GovernmentLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class GovernmentLoginController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check() && Gate::allows('access-government-portal')) {
            return redirect()->route('government.dashboard');
        }

        return view('auth.government-login');
    }

    public function store(GovernmentLoginRequest $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
        ];

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->safe()->only('email', 'remember'))
                ->withErrors(['email' => 'بيانات تسجيل الدخول غير صحيحة.']);
        }

        $request->session()->regenerate();

        if (Gate::denies('access-government-portal')) {
            Auth::logout();

            return back()->withErrors(['email' => 'هذا الحساب غير مخول للوصول إلى البوابة الحكومية.']);
        }

        return redirect()->intended(route('government.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
