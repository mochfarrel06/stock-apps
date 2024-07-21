<?php

namespace App\Http\Requests\Admin\UnitType;

use Illuminate\Foundation\Http\FormRequest;

class UnitTypeCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:unit_types,name', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Satuan barang tidak boleh kosong',
            'name.unique' => 'Nama satuan barang sudah di tambahkan'
        ];
    }
}
