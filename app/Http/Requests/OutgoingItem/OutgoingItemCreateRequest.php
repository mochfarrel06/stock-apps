<?php

namespace App\Http\Requests\OutgoingItem;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class OutgoingItemCreateRequest extends FormRequest
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
            'item_id' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric', 'min:1', function ($attribute, $value, $fail) {
                $item = Item::find($this->item_id);
                if ($item && $value > $item->stock) {
                    $fail('Jumlah barang keluar tidak boleh lebih dari stok yang ada.');
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'item_id.required' => 'Data barang tidak boleh kosong',
            'item_id.exists' => 'Data barang tidak ditemukan',
            'quantity.required' => 'Jumlah barang keluar tidak boleh kosong',
            'quantity.numeric' => 'Jumlah barang keluar harus berupa angka',
            'quantity.min' => 'Jumlah barang keluar tidak boleh kurang dari 1',
        ];
    }
}
