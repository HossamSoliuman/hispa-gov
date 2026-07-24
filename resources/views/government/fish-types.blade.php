<x-layouts.government title="أنواع الأسماك">
    <x-government.page-heading
        eyebrow="أنواع الأسماك / حركة الأسماك"
        title="أنواع الأسماك"
        description="متابعة الأصناف المسجلة والإنتاج والتصدير ومتوسط السعر">
        <x-slot:actions>
            <button class="owner-button owner-button--outline" type="button" data-print>
                <x-government.icon class="gov-button-icon" name="print" />
                طباعة
            </button>
        </x-slot:actions>
    </x-government.page-heading>

    <section class="owner-kpis" aria-label="ملخص أنواع الأسماك">
        <x-government.stat-card label="عدد الأصناف" value="0" icon="species" />
        <x-government.stat-card label="الوزن الإجمالي الناتج" value="0 كغم" icon="weight" />
        <x-government.stat-card label="الوزن الإجمالي الصادر" value="0 كغم" icon="export" />
        <x-government.stat-card label="إجمالي الأنواع المسجلة" value="0" icon="list" />
    </section>

    <x-government.panel class="gov-filter-card">
        <div class="owner-card__body">
            <form method="GET" action="{{ route('government.fish-types') }}">
                <div class="gov-filters gov-filters--five">
                    <div class="gov-field-group">
                        <label class="gov-label" for="species">الصنف</label>
                        <input class="owner-field" id="species" name="species" type="search" value="{{ request('species') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="average_price">متوسط السعر</label>
                        <input class="owner-field" id="average_price" name="average_price" type="number" min="0" step="0.01" value="{{ request('average_price') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="production">الإنتاج</label>
                        <input class="owner-field" id="production" name="production" type="number" min="0" step="0.01" value="{{ request('production') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="export">التصدير</label>
                        <input class="owner-field" id="export" name="export" type="number" min="0" step="0.01" value="{{ request('export') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="sustainability">الحالة (مستدام أو تعافي)</label>
                        <select class="owner-field" id="sustainability" name="sustainability">
                            <option value="">الكل</option>
                            <option value="sustainable" @selected(request('sustainability') === 'sustainable')>مستدام</option>
                            <option value="recovering" @selected(request('sustainability') === 'recovering')>تعافي</option>
                        </select>
                    </div>
                </div>
                <div class="gov-filter-actions">
                    <button class="owner-button" type="submit">
                        <x-government.icon class="gov-button-icon" name="search" />
                        بحث
                    </button>
                    <a class="owner-button gov-button--muted" href="{{ route('government.fish-types') }}">
                        <x-government.icon class="gov-button-icon" name="reset" />
                        إعادة تعيين
                    </a>
                </div>
            </form>
        </div>
    </x-government.panel>

    <x-government.panel title="سجل أنواع الأسماك" badge="0 نتيجة">
        <div class="owner-table-scroll">
            <table class="owner-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الصنف</th>
                        <th>متوسط السعر</th>
                        <th>الإنتاج</th>
                        <th>التصدير</th>
                        <th>الحالة (مستدام أو تعافي)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gov-table-empty">
                        <td colspan="6">
                            <strong>لا يوجد بيانات متاحة في الجدول</strong>
                            <span>ستظهر الأصناف المسجلة هنا.</span>
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
