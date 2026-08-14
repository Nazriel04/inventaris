<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommodityConditionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:commodity_conditions,name|max:100',
            'badge_color' => 'required|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kondisi wajib diisi.',
            'name.unique' => 'Nama kondisi sudah ada.',
            'badge_color.required' => 'Warna badge wajib dipilih.',
        ];
    }
}