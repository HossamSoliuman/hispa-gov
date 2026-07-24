<x-layouts.government title="أدوات الصيد">
    <x-government.page-heading
        eyebrow="أدوات الصيد / إدارة الأدوات"
        title="ضبط أدوات الصيد"
        description="إدارة أدوات الصيد المعتمدة وحالتها التشغيلية">
        <x-slot:actions>
            <button class="owner-button" type="button" data-dialog-open="fishing-tool-dialog">
                <x-government.icon class="gov-button-icon" name="plus" />
                إضافة
            </button>
            <button class="owner-button owner-button--outline" type="button" data-print>
                <x-government.icon class="gov-button-icon" name="print" />
                طباعة
            </button>
        </x-slot:actions>
    </x-government.page-heading>

    <x-government.panel class="gov-filter-card">
        <div class="owner-card__body">
            <form method="GET" action="{{ route('government.fishing-tools.index') }}">
                <div class="gov-filters">
                    <div class="gov-field-group">
                        <label class="gov-label" for="name">اسم الأداة</label>
                        <input class="owner-field" id="name" name="name" type="search" value="{{ request('name') }}">
                    </div>
                    <div class="gov-field-group">
                        <label class="gov-label" for="status">الحالة</label>
                        <select class="owner-field" id="status" name="status">
                            <option value="">الكل</option>
                            <option value="active" @selected(request('status') === 'active')>نشط</option>
                            <option value="inactive" @selected(request('status') === 'inactive')>غير نشط</option>
                        </select>
                    </div>
                </div>
                <div class="gov-filter-actions">
                    <button class="owner-button" type="submit">
                        <x-government.icon class="gov-button-icon" name="search" />
                        بحث
                    </button>
                    <a class="owner-button gov-button--muted" href="{{ route('government.fishing-tools.index') }}">
                        <x-government.icon class="gov-button-icon" name="reset" />
                        إعادة تعيين
                    </a>
                </div>
            </form>
        </div>
    </x-government.panel>

    <x-government.panel title="أدوات الصيد المسجلة" :badge="$fishingTools->total().' نتيجة'">
        <div class="owner-table-scroll">
            <table class="owner-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الأداة</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fishingTools as $fishingTool)
                        <tr>
                            <td>{{ $fishingTool->id }}</td>
                            <td>{{ $fishingTool->name }}</td>
                            <td>
                                <span @class(['owner-badge', 'owner-badge--success' => $fishingTool->status === 'active'])>
                                    {{ $fishingTool->status === 'active' ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td><span class="owner-badge">عرض</span></td>
                        </tr>
                    @empty
                        <tr class="gov-table-empty">
                            <td colspan="4">
                                <strong>لا يوجد بيانات متاحة في الجدول</strong>
                                <span>أضف أداة صيد جديدة للبدء.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="gov-table-meta">
            <span>يعرض {{ $fishingTools->firstItem() ?? 0 }} إلى {{ $fishingTools->lastItem() ?? 0 }} من أصل {{ $fishingTools->total() }} مدخل</span>
            <div class="owner-pagination" aria-label="ترقيم الصفحات">
                @if ($fishingTools->previousPageUrl())
                    <a class="owner-page-button" href="{{ $fishingTools->previousPageUrl() }}" aria-label="السابق">‹</a>
                @else
                    <button class="owner-page-button" type="button" disabled aria-label="السابق">‹</button>
                @endif
                <span class="owner-page-button" aria-current="page">{{ $fishingTools->currentPage() }}</span>
                @if ($fishingTools->nextPageUrl())
                    <a class="owner-page-button" href="{{ $fishingTools->nextPageUrl() }}" aria-label="التالي">›</a>
                @else
                    <button class="owner-page-button" type="button" disabled aria-label="التالي">›</button>
                @endif
            </div>
        </div>
    </x-government.panel>

    <dialog class="gov-dialog" id="fishing-tool-dialog" @if ($errors->any()) data-auto-open @endif>
        <form method="POST" action="{{ route('government.fishing-tools.store') }}">
            @csrf
            <header class="gov-dialog__header">
                <h2>إضافة أداة صيد</h2>
                <button class="owner-icon-button" type="button" data-dialog-close aria-label="إغلاق">
                    <x-government.icon name="close" />
                </button>
            </header>
            <div class="gov-dialog__body">
                <div class="gov-field-group">
                    <label class="gov-label" for="tool_name">اسم الأداة <span class="gov-required">*</span></label>
                    <input class="owner-field" id="tool_name" name="name" type="text" value="{{ old('name') }}" required>
                    @error('name') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>
                <div class="gov-field-group">
                    <label class="gov-label" for="tool_status">الحالة <span class="gov-required">*</span></label>
                    <select class="owner-field" id="tool_status" name="status" required>
                        <option value="active" @selected(old('status', 'active') === 'active')>نشط</option>
                        <option value="inactive" @selected(old('status') === 'inactive')>غير نشط</option>
                    </select>
                    @error('status') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>
            </div>
            <footer class="gov-dialog__footer">
                <button class="owner-button" type="submit">
                    <x-government.icon class="gov-button-icon" name="save" />
                    حفظ
                </button>
                <button class="owner-button gov-button--muted" type="button" data-dialog-close>إلغاء</button>
            </footer>
        </form>
    </dialog>
</x-layouts.government>
