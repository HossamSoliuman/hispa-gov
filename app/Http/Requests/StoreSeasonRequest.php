<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreSeasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('access-government-portal') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'status' => ['required', Rule::in(array_keys(config('government.season_statuses')))],
            'region' => ['required', Rule::in(config('government.regions'))],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'fishing_tools' => ['required', 'array', 'min:1'],
            'fishing_tools.*' => ['required', 'string', Rule::in(config('government.fishing_tool_options'))],
            'licenses_count' => ['required', 'integer', 'min:0'],
            'minimum_size' => ['nullable', 'numeric', 'min:0'],
            'maximum_size' => ['nullable', 'numeric', 'min:0'],
            'restrictions' => ['required', 'string', 'max:2000'],
        ];
    }

    /**
     * @return array<int, callable(Validator): void>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                if ($this->filled(['minimum_size', 'maximum_size']) && $this->float('minimum_size') > $this->float('maximum_size')) {
                    $validator->errors()->add('maximum_size', 'يجب أن يكون الحد الأعلى أكبر من الحد الأدنى أو مساوياً له.');
                }
            },
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'اسم الموسم',
            'status' => 'الحالة',
            'region' => 'المنطقة',
            'start_date' => 'الفترة من',
            'end_date' => 'الفترة إلى',
            'fishing_tools' => 'أدوات الصيد',
            'licenses_count' => 'عدد الرخص الموسمية',
            'minimum_size' => 'الحد الأدنى للقياس',
            'maximum_size' => 'الحد الأعلى للقياس',
            'restrictions' => 'القيود',
        ];
    }
}
