<?php

use App\Models\FishingTool;
use App\Models\Season;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('shows the simple government login screen', function () {
    $this->get(route('login'))
        ->assertSuccessful()
        ->assertSee('تسجيل دخول')
        ->assertSee('لحمايتك، يرجى التحقق من هويتك!')
        ->assertSee('البريد الإلكتروني')
        ->assertSee('تذكرني');
});

it('redirects guests away from protected phase one screens', function (string $routeName) {
    $this->get(route($routeName))->assertRedirect(route('login'));
})->with([
    'dashboard' => 'government.dashboard',
    'production' => 'government.production',
    'seasons' => 'government.seasons.index',
    'create season' => 'government.seasons.create',
    'fish types' => 'government.fish-types',
    'workforce' => 'government.workforce',
    'fishing tools' => 'government.fishing-tools.index',
]);

it('authenticates the configured government user', function () {
    $governmentUser = User::factory()->create([
        'email' => config('government.user.email'),
        'password' => 'password',
    ]);

    $this->post(route('login.store'), [
        'email' => $governmentUser->email,
        'password' => 'password',
        'remember' => true,
    ])->assertRedirect(route('government.dashboard'));

    $this->assertAuthenticatedAs($governmentUser);
});

it('rejects invalid login credentials', function () {
    User::factory()->create([
        'email' => config('government.user.email'),
        'password' => 'password',
    ]);

    $this->from(route('login'))->post(route('login.store'), [
        'email' => config('government.user.email'),
        'password' => 'incorrect-password',
    ])->assertRedirect(route('login'))->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('renders every phase one portal screen for the government user', function (string $routeName, string $heading) {
    $governmentUser = User::factory()->create([
        'email' => config('government.user.email'),
    ]);

    $this->actingAs($governmentUser)
        ->get(route($routeName))
        ->assertSuccessful()
        ->assertSee($heading);
})->with([
    'dashboard' => ['government.dashboard', 'لوحة التحكم الحكومية'],
    'production' => ['government.production', 'الإنتاج السمكي'],
    'seasons' => ['government.seasons.index', 'ضبط المواسم'],
    'create season' => ['government.seasons.create', 'إنشاء موسم جديد'],
    'fish types' => ['government.fish-types', 'أنواع الأسماك'],
    'workforce' => ['government.workforce', 'ضبط القوى العاملة'],
    'fishing tools' => ['government.fishing-tools.index', 'ضبط أدوات الصيد'],
]);

it('forbids authenticated users who are not government users', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('government.dashboard'))
        ->assertForbidden();
});

it('creates a fishing season from the referenced form', function () {
    $governmentUser = User::factory()->create([
        'email' => config('government.user.email'),
    ]);

    $response = $this->actingAs($governmentUser)->post(route('government.seasons.store'), [
        'name' => 'موسم الروبيان',
        'status' => 'upcoming',
        'region' => config('government.regions.0'),
        'start_date' => '2026-08-01',
        'end_date' => '2026-09-30',
        'fishing_tools' => [config('government.fishing_tool_options.0')],
        'licenses_count' => 25,
        'minimum_size' => 10.5,
        'maximum_size' => 25,
        'restrictions' => 'يمنع الصيد خارج الموانئ المعتمدة.',
    ]);

    $response->assertRedirect(route('government.seasons.index'));

    $season = Season::query()->where('name', 'موسم الروبيان')->firstOrFail();

    $this->assertModelExists($season);
    expect($season->licenses_count)->toBe(25)
        ->and($season->fishing_tools)->toBe([config('government.fishing_tool_options.0')]);
});

it('validates the season measurement range', function () {
    $governmentUser = User::factory()->create([
        'email' => config('government.user.email'),
    ]);

    $this->actingAs($governmentUser)
        ->from(route('government.seasons.create'))
        ->post(route('government.seasons.store'), [
            'name' => 'موسم تجريبي',
            'status' => 'active',
            'region' => config('government.regions.0'),
            'start_date' => '2026-08-01',
            'end_date' => '2026-09-30',
            'fishing_tools' => [config('government.fishing_tool_options.0')],
            'licenses_count' => 2,
            'minimum_size' => 30,
            'maximum_size' => 20,
            'restrictions' => 'قيود الموسم.',
        ])
        ->assertRedirect(route('government.seasons.create'))
        ->assertSessionHasErrors('maximum_size');
});

it('adds a fishing tool from the phase one dialog', function () {
    $governmentUser = User::factory()->create([
        'email' => config('government.user.email'),
    ]);

    $this->actingAs($governmentUser)
        ->post(route('government.fishing-tools.store'), [
            'name' => 'شبكة تجريبية',
            'status' => 'active',
        ])
        ->assertRedirect(route('government.fishing-tools.index'));

    $fishingTool = FishingTool::query()->where('name', 'شبكة تجريبية')->firstOrFail();

    $this->assertModelExists($fishingTool);
    expect($fishingTool->status)->toBe('active');
});

it('logs the government user out', function () {
    $governmentUser = User::factory()->create([
        'email' => config('government.user.email'),
    ]);

    $this->actingAs($governmentUser)
        ->post(route('government.logout'))
        ->assertRedirect(route('login'));

    $this->assertGuest();
});
