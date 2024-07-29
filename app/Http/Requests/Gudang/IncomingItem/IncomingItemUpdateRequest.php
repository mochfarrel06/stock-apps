<?php

namespace App\Http\Requests\Gudang\IncomingItem;

use Illuminate\Foundation\Http\FormRequest;

class IncomingItemUpdateRequest extends FormRequest
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
            'quantity' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'item_id.required' => 'Data barang tidak boleh kosong',
            'quantity.required' => 'Jumlah barang masuk tidak boleh kosong',
            'quantity.min' => 'Jumlah barang masuk tidak boleh kurang dari 1'
        ];
    }
}
