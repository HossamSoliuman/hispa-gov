<?php

use App\Models\FishingTool;
use App\Models\Season;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('seeds realistic government portal data without duplicates', function () {
    $this->seed(DatabaseSeeder::class);
    $this->seed(DatabaseSeeder::class);

    expect(User::query()->where('email', config('government.user.email'))->count())->toBe(1)
        ->and(FishingTool::query()->count())->toBe(4)
        ->and(Season::query()->count())->toBe(12)
        ->and(Season::query()->where('status', 'active')->count())->toBe(3)
        ->and(Season::query()->where('status', 'upcoming')->count())->toBe(4)
        ->and(Season::query()->where('status', 'closed')->count())->toBe(5);

    $shrimpSeason = Season::query()
        ->where('name', 'موسم صيد الروبيان في الخليج العربي')
        ->firstOrFail();

    expect($shrimpSeason->region)->toBe(config('government.regions.0'))
        ->and($shrimpSeason->fishing_tools)->toContain(config('government.fishing_tool_options.0'))
        ->and($shrimpSeason->licenses_count)->toBe(186);
});
