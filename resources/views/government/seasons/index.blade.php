<x-layouts.government title="المواسم">
    <x-government.page-heading
        eyebrow="المواسم / إدارة المواسم"
        title="ضبط المواسم"
        description="إدارة فترات الصيد والرخص والقيود الموسمية">
        <x-slot:actions>
            <a class="owner-button" href="{{ route('government.seasons.create') }}">
                <x-government.icon class="gov-button-icon" name="plus" />
                إضافة
            </a>
            <button class="owner-button owner-button--outline" type="button" data-print>
                <x-government.icon class="gov-button-icon" name="print" />
                طباعة
            </button>
        </x-slot:actions>
    </x-government.page-heading>

    <section class="owner-kpis" aria-label="ملخص المواسم">
        <x-government.stat-card label="المواسم القادمة" :value="(string) $upcomingSeasons" icon="calendar" />
        <x-government.stat-card label="المواسم النشطة" :value="(string) $activeSeasons" icon="speed" />
        <x-government.stat-card label="عدد الرخص الموسمية" :value="(string) $licensesCount" icon="licenses" />
        <x-government.stat-card label="إجمالي المواسم" :value="(string) $totalSeasons" icon="list" />
    </section>

    <x-government.panel class="gov-filter-card">
        <div class="owner-card__body">
            <form method="GET" action="{{ route('government.seasons.index') }}">
                <div class="gov-filters">
                    <div class="gov-field-group">
                        <label class="gov-label" for="from">من تاريخ</label>
                        <input class="owner-field" id="from" name="from" type="date" value="{{ request('from') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="to">إلى تاريخ</label>
                        <input class="owner-field" id="to" name="to" type="date" value="{{ request('to') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="status">الحالة</label>
                        <select class="owner-field" id="status" name="status">
                            <option value="">الكل</option>
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="search">ابحث</label>
                        <input class="owner-field" id="search" name="search" type="search" value="{{ request('search') }}" placeholder="مثال: موسم الروبيان">
                    </div>
                </div>
                <div class="gov-filter-actions">
                    <button class="owner-button" type="submit">
                        <x-government.icon class="gov-button-icon" name="search" />
                        تصفية
                    </button>
                    <a class="owner-button gov-button--muted" href="{{ route('government.seasons.index') }}">
                        <x-government.icon class="gov-button-icon" name="reset" />
                        إعادة تعيين
                    </a>
                </div>
            </form>
        </div>
    </x-government.panel>

    <x-government.panel title="المواسم المسجلة" :badge="$seasons->total().' نتيجة'">
        <div class="owner-table-scroll">
            <table class="owner-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الموسم</th>
                        <th>الحالة</th>
                        <th>المنطقة</th>
                        <th>الفترة (من - إلى)</th>
                        <th>عدد الرخص الموسمية</th>
                        <th>الحد الأدنى</th>
                        <th>الحد الأعلى</th>
                        <th>أدوات الصيد</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($seasons as $season)
                        <tr>
                            <td>{{ $season->id }}</td>
                            <td>{{ $season->name }}</td>
                            <td class="gov-status-cell">
                                <span @class([
                                    'owner-badge',
                                    'owner-badge--success' => $season->status === 'active',
                                    'owner-badge--warning' => $season->status === 'upcoming',
                                ])>{{ $statuses[$season->status] }}</span>
                            </td>
                            <td>{{ $season->region }}</td>
                            <td>{{ $season->start_date->format('Y/m/d') }} - {{ $season->end_date->format('Y/m/d') }}</td>
                            <td>{{ $season->licenses_count }}</td>
                            <td>{{ $season->minimum_size ? $season->minimum_size.' سم' : '—' }}</td>
                            <td>{{ $season->maximum_size ? $season->maximum_size.' سم' : '—' }}</td>
                            <td>{{ implode('، ', $season->fishing_tools) }}</td>
                        </tr>
                    @empty
                        <tr class="gov-table-empty">
                            <td colspan="9">
                                <strong>لا يوجد بيانات متاحة في الجدول</strong>
                                <span>أضف موسماً جديداً أو غيّر معايير التصفية.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="gov-table-meta">
            <span>يعرض {{ $seasons->firstItem() ?? 0 }} إلى {{ $seasons->lastItem() ?? 0 }} من أصل {{ $seasons->total() }} مدخل</span>
            <div class="owner-pagination" aria-label="ترقيم الصفحات">
                @if ($seasons->previousPageUrl())
                    <a class="owner-page-button" href="{{ $seasons->previousPageUrl() }}" aria-label="السابق">‹</a>
                @else
                    <button class="owner-page-button" type="button" disabled aria-label="السابق">‹</button>
                @endif
                <span class="owner-page-button" aria-current="page">{{ $seasons->currentPage() }}</span>
                @if ($seasons->nextPageUrl())
                    <a class="owner-page-button" href="{{ $seasons->nextPageUrl() }}" aria-label="التالي">›</a>
                @else
                    <button class="owner-page-button" type="button" disabled aria-label="التالي">›</button>
                @endif
            </div>
        </div>
    </x-government.panel>
</x-layouts.government>
