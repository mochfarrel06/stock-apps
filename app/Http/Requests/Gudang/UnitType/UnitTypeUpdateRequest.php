<?php

namespace App\Http\Requests\Gudang\UnitType;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UnitTypeUpdateRequest extends FormRequest
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
        $unitTypeId = $this->route('unit_type');
        return [
            'name' => ['required', 'string', 'max:255',  Rule::unique('unit_types', 'name')->ignore($unitTypeId)]
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
