<?php

namespace App\Http\Requests\Gudang\ItemType;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ItemTypeUpdateRequest extends FormRequest
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
        $itemTypeId = $this->route('item_type');
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('item_types', 'name')->ignore($itemTypeId)
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Jenis barang tidak boleh kosong',
            'name.unique' => 'Nama jenis barang sudah di tambahkan'
        ];
    }
}
