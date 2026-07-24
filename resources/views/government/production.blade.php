<x-layouts.government title="الإنتاج السمكي">
    <x-government.page-heading
        eyebrow="الإنتاج السمكي / الإنتاج حسب المنطقة"
        title="الإنتاج السمكي"
        description="متابعة الإنتاج والموانئ والمحافظات في مناطق المملكة">
        <x-slot:actions>
            <button class="owner-button owner-button--outline" type="button" data-print>
                <x-government.icon class="gov-button-icon" name="print" />
                طباعة
            </button>
        </x-slot:actions>
    </x-government.page-heading>

    <section class="owner-kpis" aria-label="ملخص الإنتاج السمكي">
        <x-government.stat-card label="عدد المناطق" value="0" icon="globe" />
        <x-government.stat-card label="عدد المحافظات" value="0" icon="governorates" />
        <x-government.stat-card label="عدد الموانئ" value="0" icon="port" />
        <x-government.stat-card label="الوزن الإجمالي" value="0.00 كغم" icon="weight" />
    </section>

    <x-government.panel class="gov-filter-card">
        <div class="owner-card__body">
            <form method="GET" action="{{ route('government.production') }}">
                <div class="gov-filters">
                    <div class="gov-field-group">
                        <label class="gov-label" for="region">المنطقة</label>
                        <select class="owner-field" id="region" name="region">
                            <option value="">الكل</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region }}" @selected($selectedRegion === $region)>{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="gov-filter-actions">
                    <button class="owner-button" type="submit">
                        <x-government.icon class="gov-button-icon" name="search" />
                        بحث
                    </button>
                    <a class="owner-button gov-button--muted" href="{{ route('government.production') }}">
                        <x-government.icon class="gov-button-icon" name="reset" />
                        إعادة تعيين
                    </a>
                </div>
            </form>
        </div>
    </x-government.panel>

    <x-government.panel title="سجل الإنتاج حسب المنطقة" badge="0 نتيجة">
        <div class="owner-table-scroll">
            <table class="owner-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المنطقة</th>
                        <th>المحافظة</th>
                        <th>الموانئ</th>
                        <th>معدل الإنتاج</th>
                        <th>نسبة الإنتاج</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gov-table-empty">
                        <td colspan="6">
                            <strong>لا يوجد بيانات متاحة في الجدول</strong>
                            <span>استخدم مرشح المنطقة لتضييق نطاق النتائج.</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="gov-table-meta">
            <span>يعرض 0 إلى 0 من أصل 0 مدخل</span>
            <div class="owner-pagination" aria-label="ترقيم الصفحات">
                <button class="owner-page-button" type="button" disabled>الأول</button>
                <button class="owner-page-button" type="button" disabled>السابق</button>
                <button class="owner-page-button" type="button" disabled>التالي</button>
                <button class="owner-page-button" type="button" disabled>الأخير</button>
            </div>
        </div>
    </x-government.panel>
</x-layouts.government>
