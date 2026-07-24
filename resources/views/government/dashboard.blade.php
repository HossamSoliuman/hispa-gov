<x-layouts.government title="لوحة التحكم">
    <x-government.page-heading
        eyebrow="لوحة التحكم / النظرة العامة"
        title="لوحة التحكم الحكومية"
        description="نظرة عامة على الأداء والعمليات الحكومية">
        <x-slot:actions>
            <form method="POST" action="{{ route('government.dashboard.refresh') }}">
                @csrf
                <button class="owner-button owner-button--outline" type="submit">
                    <x-government.icon class="gov-button-icon" name="refresh" />
                    تحديث الذاكرة المؤقتة
                </button>
            </form>
        </x-slot:actions>
    </x-government.page-heading>

    <section class="gov-banner" aria-label="هوية النظام الحكومي">
        <div class="gov-banner__identity">
            <span class="gov-banner__icon"><x-government.icon name="speed" /></span>
            <div>
                <h2>الصيد البحري في المملكة العربية السعودية</h2>
                <p>المملكة العربية السعودية · وزارة البيئة والمياه والزراعة</p>
            </div>
        </div>
        <div class="gov-banner__time" data-riyadh-clock>
            <strong>توقيت الرياض <time data-riyadh-time>{{ $riyadhTime }}</time></strong>
            <time data-riyadh-date>{{ $riyadhDate }}</time>
        </div>
    </section>

    <section class="owner-kpis gov-dashboard-kpis" aria-label="المؤشرات الرئيسية">
        <x-government.stat-card label="رحلات الصيد" value="0" icon="boat" meta="إجمالي الرحلات المسجلة" />
        <x-government.stat-card label="البحارة النشطين" value="0" icon="users" meta="بحار يعمل حالياً" />
        <x-government.stat-card label="الإنتاج (المجموع السنوي)" value="0.0 كغم" icon="production" meta="إجمالي الإنتاج هذا العام" />
        <x-government.stat-card label="المبيعات" value="0 ر.س" icon="money" meta="قيمة المبيعات المسجلة" />
        <x-government.stat-card label="عدد مواسم الصيد" :value="(string) $activeSeasons" icon="calendar" meta="المواسم النشطة حالياً" />
        <x-government.stat-card label="عدد المرافق" value="0" icon="port" meta="المرافق البحرية المسجلة" />
        <x-government.stat-card label="قيمة الإنتاج" value="0 ر.س" icon="sales" meta="القيمة التقديرية للإنتاج" />
        <x-government.stat-card label="نسبة نشاط الرحلات" value="0%" icon="percentage" meta="الرحلات النشطة من الإجمالي" />
    </section>

    <div class="owner-section-head">
        <span class="owner-section-head__icon"><x-government.icon name="chart" /></span>
        <h2>مؤشرات التشغيل</h2>
        <span class="owner-section-head__line"></span>
    </div>

    <div class="gov-dashboard-grid">
        <x-government.panel title="رحلات الصيادين" badge="تحديث مباشر">
            <div class="gov-chart-placeholder">
                <div class="gov-empty-state">
                    <span class="gov-empty-state__icon"><x-government.icon name="boat" /></span>
                    <strong>لا توجد رحلات مسجلة</strong>
                    <p>ستظهر حركة رحلات الصيد هنا عند توفر بيانات.</p>
                </div>
            </div>
        </x-government.panel>

        <x-government.panel title="الإنتاج السمكي" badge="كغم">
            <div class="gov-chart-placeholder">
                <div class="gov-empty-state">
                    <span class="gov-empty-state__icon"><x-government.icon name="production" /></span>
                    <strong>لا توجد بيانات إنتاج</strong>
                    <p>سيظهر توزيع الإنتاج السمكي بمجرد تسجيله.</p>
                </div>
            </div>
        </x-government.panel>
    </div>
</x-layouts.government>
