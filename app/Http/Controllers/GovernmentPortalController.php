<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFishingToolRequest;
use App\Http\Requests\StoreSeasonRequest;
use App\Models\FishingTool;
use App\Models\Season;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class GovernmentPortalController extends Controller
{
    public function dashboard(): View
    {
        $riyadhNow = now('Asia/Riyadh')->locale('ar');

        return view('government.dashboard', [
            'riyadhTime' => $riyadhNow->translatedFormat('h:i:s A'),
            'riyadhDate' => $riyadhNow->translatedFormat('l، j F Y'),
            'activeSeasons' => Season::query()->where('status', 'active')->count(),
            'fishingToolsCount' => FishingTool::query()->count(),
        ]);
    }

    public function refreshDashboard(): RedirectResponse
    {
        Cache::forget('government.dashboard');

        return back()->with('status', 'تم تحديث بيانات لوحة التحكم بنجاح.');
    }

    public function production(Request $request): View
    {
        return view('government.production', [
            'regions' => config('government.regions'),
            'selectedRegion' => $request->string('region')->toString(),
        ]);
    }

    public function seasons(Request $request): View
    {
        $seasons = Season::query()
            ->select([
                'id',
                'name',
                'status',
                'region',
                'start_date',
                'end_date',
                'licenses_count',
                'fishing_tools',
                'minimum_size',
                'maximum_size',
                'created_at',
            ])
            ->when($request->filled('from'), fn (Builder $query): Builder => $query->whereDate('start_date', '>=', $request->date('from')))
            ->when($request->filled('to'), fn (Builder $query): Builder => $query->whereDate('end_date', '<=', $request->date('to')))
            ->when($request->filled('status'), fn (Builder $query): Builder => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('search'), fn (Builder $query): Builder => $query->where('name', 'like', '%'.$request->string('search')->trim()->toString().'%'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('government.seasons.index', [
            'seasons' => $seasons,
            'totalSeasons' => Season::query()->count(),
            'activeSeasons' => Season::query()->where('status', 'active')->count(),
            'upcomingSeasons' => Season::query()->where('status', 'upcoming')->count(),
            'licensesCount' => Season::query()->sum('licenses_count'),
            'statuses' => config('government.season_statuses'),
        ]);
    }

    public function createSeason(): View
    {
        return view('government.seasons.create', [
            'regions' => config('government.regions'),
            'statuses' => config('government.season_statuses'),
            'fishingTools' => config('government.fishing_tool_options'),
        ]);
    }

    public function storeSeason(StoreSeasonRequest $request): RedirectResponse
    {
        Season::query()->create($request->validated());

        return redirect()
            ->route('government.seasons.index')
            ->with('status', 'تم إنشاء موسم الصيد بنجاح.');
    }

    public function fishTypes(): View
    {
        return view('government.fish-types');
    }

    public function workforce(): View
    {
        return view('government.workforce', [
            'regions' => config('government.regions'),
        ]);
    }

    public function fishingTools(Request $request): View
    {
        $fishingTools = FishingTool::query()
            ->select(['id', 'name', 'status', 'created_at'])
            ->when($request->filled('name'), fn (Builder $query): Builder => $query->where('name', 'like', '%'.$request->string('name')->trim()->toString().'%'))
            ->when($request->filled('status'), fn (Builder $query): Builder => $query->where('status', $request->string('status')->toString()))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('government.fishing-tools', [
            'fishingTools' => $fishingTools,
        ]);
    }

    public function storeFishingTool(StoreFishingToolRequest $request): RedirectResponse
    {
        FishingTool::query()->create($request->validated());

        return redirect()
            ->route('government.fishing-tools.index')
            ->with('status', 'تمت إضافة أداة الصيد بنجاح.');
    }
}
