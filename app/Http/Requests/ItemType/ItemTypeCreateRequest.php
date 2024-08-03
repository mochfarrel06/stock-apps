<?php

namespace App\Http\Requests\ItemType;

use Illuminate\Foundation\Http\FormRequest;

class ItemTypeCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:item_types,name', 'max:255']
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
