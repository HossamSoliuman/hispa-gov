<x-layouts.government title="إنشاء موسم جديد">
    <x-government.page-heading
        eyebrow="إدارة المواسم / إنشاء موسم جديد"
        title="إنشاء موسم جديد"
        description="حدد بيانات الموسم والفترة والقيود المنظمة للصيد">
        <x-slot:actions>
            <a class="owner-button owner-button--outline" href="{{ route('government.seasons.index') }}">
                <x-government.icon class="gov-button-icon" name="back" />
                رجوع
            </a>
        </x-slot:actions>
    </x-government.page-heading>

    @if ($errors->any())
        <div class="gov-flash gov-flash--danger" role="alert">
            <span>يرجى مراجعة الحقول المحددة قبل حفظ الموسم.</span>
        </div>
    @endif

    <x-government.panel title="بيانات الموسم">
        <form class="owner-card__body" method="POST" action="{{ route('government.seasons.store') }}">
            @csrf

            <div class="gov-form-grid">
                <div class="gov-field-group">
                    <label class="gov-label" for="name">الاسم <span class="gov-required">*</span></label>
                    <input class="owner-field" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="اسم الموسم" required>
                    @error('name') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="gov-field-group">
                    <label class="gov-label" for="status">الحالة <span class="gov-required">*</span></label>
                    <select class="owner-field" id="status" name="status" required>
                        <option value="">اختر</option>
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}" @selected(old('status') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="gov-field-group">
                    <label class="gov-label" for="region">اسم المنطقة <span class="gov-required">*</span></label>
                    <select class="owner-field" id="region" name="region" required>
                        <option value="">اختر</option>
                        @foreach ($regions as $region)
                            <option value="{{ $region }}" @selected(old('region') === $region)>{{ $region }}</option>
                        @endforeach
                    </select>
                    @error('region') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="gov-field-group">
                    <label class="gov-label" for="start_date">الفترة من <span class="gov-required">*</span></label>
                    <input class="owner-field" id="start_date" name="start_date" type="date" value="{{ old('start_date') }}" required>
                    @error('start_date') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="gov-field-group">
                    <label class="gov-label" for="end_date">الفترة إلى <span class="gov-required">*</span></label>
                    <input class="owner-field" id="end_date" name="end_date" type="date" value="{{ old('end_date') }}" required>
                    @error('end_date') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="gov-field-group">
                    <span class="gov-label" id="fishing_tools_label">أدوات الصيد <span class="gov-required">*</span></span>
                    <details @class(['gov-multi-select', 'gov-multi-select--invalid' => $errors->has('fishing_tools')]) data-multi-select>
                        <summary class="owner-field gov-multi-select__summary">
                            <span data-multi-select-label data-placeholder="اختر أدوات الصيد">اختر أدوات الصيد</span>
                            <span class="gov-multi-select__chevron" aria-hidden="true"></span>
                        </summary>
                        <div class="gov-multi-select__menu" role="group" aria-labelledby="fishing_tools_label">
                            @foreach ($fishingTools as $fishingTool)
                                <label class="gov-multi-select__option">
                                    <input name="fishing_tools[]" type="checkbox" value="{{ $fishingTool }}"
                                        @checked(in_array($fishingTool, old('fishing_tools', []), true))>
                                    <span>{{ $fishingTool }}</span>
                                </label>
                            @endforeach
                        </div>
                    </details>
                    <p class="gov-form-help" id="fishing_tools_help">يمكن اختيار أكثر من أداة.</p>
                    @error('fishing_tools') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="gov-field-group">
                    <label class="gov-label" for="licenses_count">عدد الرخص الموسمية <span class="gov-required">*</span></label>
                    <input class="owner-field" id="licenses_count" name="licenses_count" type="number" min="0" value="{{ old('licenses_count', 0) }}" required>
                    @error('licenses_count') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="gov-field-group">
                    <label class="gov-label" for="minimum_size">الحد الأدنى للقياس (سم)</label>
                    <input class="owner-field" id="minimum_size" name="minimum_size" type="number" min="0" step="0.01" value="{{ old('minimum_size') }}" placeholder="مثال: 10.5">
                    @error('minimum_size') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="gov-field-group">
                    <label class="gov-label" for="maximum_size">الحد الأعلى للقياس (سم)</label>
                    <input class="owner-field" id="maximum_size" name="maximum_size" type="number" min="0" step="0.01" value="{{ old('maximum_size') }}" placeholder="مثال: 25.0">
                    @error('maximum_size') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="gov-field-group gov-form-span-full">
                    <label class="gov-label" for="restrictions">القيود <span class="gov-required">*</span></label>
                    <textarea class="owner-field" id="restrictions" name="restrictions" placeholder="اكتب القيود هنا" required>{{ old('restrictions') }}</textarea>
                    @error('restrictions') <span class="gov-field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="gov-form-actions">
                <button class="owner-button" type="submit">
                    <x-government.icon class="gov-button-icon" name="save" />
                    حفظ
                </button>
                <a class="owner-button gov-button--muted" href="{{ route('government.seasons.index') }}">رجوع</a>
            </div>
        </form>
    </x-government.panel>
</x-layouts.government>
