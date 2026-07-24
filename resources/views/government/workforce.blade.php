<x-layouts.government title="القوى العاملة">
    <x-government.page-heading
        eyebrow="القوى العاملة / إدارة البحارة"
        title="ضبط القوى العاملة"
        description="متابعة البحارة المسجلين وتوزيعهم حسب المنطقة والجنسية">
        <x-slot:actions>
            <button class="owner-button owner-button--outline" type="button" data-print>
                <x-government.icon class="gov-button-icon" name="print" />
                طباعة
            </button>
        </x-slot:actions>
    </x-government.page-heading>

    <section class="owner-kpis" aria-label="ملخص القوى العاملة">
        <x-government.stat-card label="عدد القوى العاملة" value="0" icon="users" />
        <x-government.stat-card label="القوى العاملة السعودية" value="0" icon="saudi" />
        <x-government.stat-card label="القوى العاملة الأجنبية" value="0" icon="foreign" />
        <x-government.stat-card label="إجمالي البحارة المسجلين" value="0" icon="id-card" />
    </section>

    <x-government.panel class="gov-filter-card">
        <div class="owner-card__body">
            <form method="GET" action="{{ route('government.workforce') }}">
                <div class="gov-filters gov-filters--five">
                    <div class="gov-field-group">
                        <label class="gov-label" for="name">الاسم</label>
                        <input class="owner-field" id="name" name="name" type="search" value="{{ request('name') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="email">الإيميل</label>
                        <input class="owner-field" id="email" name="email" type="email" value="{{ request('email') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="mobile">رقم الجوال</label>
                        <input class="owner-field" id="mobile" name="mobile" type="tel" value="{{ request('mobile') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="region">المنطقة</label>
                        <select class="owner-field" id="region" name="region">
                            <option value="">الكل</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region }}" @selected(request('region') === $region)>{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="governorate">المحافظة</label>
                        <select class="owner-field" id="governorate" name="governorate">
                            <option value="">الكل</option>
                        </select>
                    </div>
                </div>
                <div class="gov-filter-actions">
                    <button class="owner-button" type="submit">
                        <x-government.icon class="gov-button-icon" name="search" />
                        بحث
                    </button>
                    <a class="owner-button gov-button--muted" href="{{ route('government.workforce') }}">
                        <x-government.icon class="gov-button-icon" name="reset" />
                        إعادة تعيين
                    </a>
                </div>
            </form>
        </div>
    </x-government.panel>

    <x-government.panel title="سجل القوى العاملة" badge="0 نتيجة">
        <div class="owner-table-scroll">
            <table class="owner-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الإيميل</th>
                        <th>رقم الجوال</th>
                        <th>رقم الهوية</th>
                        <th>الجنسية</th>
                        <th>المنطقة</th>
                        <th>المحافظة</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="gov-table-empty">
                        <td colspan="8">
                            <strong>لا يوجد بيانات متاحة في الجدول</strong>
                            <span>ستظهر بيانات البحارة المسجلين هنا.</span>
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
