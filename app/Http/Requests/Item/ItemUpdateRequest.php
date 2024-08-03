<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
        $itemId = $this->route('item');
        return [
            'item_type_id' => ['required', 'exists:item_types,id'],
            'unit_type_id' => ['required', 'exists:unit_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'item_code' => ['required', 'string', 'max:255', 'unique:items,item_code,' . $itemId],
            'stock' => ['nullable', 'numeric', 'min:0'],
            'reorder_level' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric'],
            'photo' => ['nullable', 'image', 'max:1000', 'mimes:png,jpg,jpeg']
        ];
    }

    public function messages()
    {
        return [
            'item_type_id.required' => 'Jenis Barang tidak boleh kosong',
            'unit_type_id.required' => 'Satuan Barang tidak boleh kosong',
            'name.required' => 'Nama Barang tidak boleh kosong',
            'item_code.required' => 'Kode Barang tidak boleh kosong',
            'item_code.unique' => 'Kode barang sudah di tambahkan',
            'reorder_level.required' => 'Stock minimum tidak boleh kosong',
            'price.required' => 'Harga Barang tidak boleh kosong',
            'photo.image' => 'File harus berupa gambar',
            'photo.max' => 'Ukuran gambar tidak boleh lebih dari 1000 KB',
            'photo.mimes' => 'Format gambar harus berupa PNG, JPG, atau JPEG'
        ];
    }
}
