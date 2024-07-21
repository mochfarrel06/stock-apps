<?php

namespace App\Http\Requests\Admin\IncomingItem;

use Illuminate\Foundation\Http\FormRequest;

class IncomingItemCreateRequest extends FormRequest
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
            'quantity' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages()
    {
        return [
            'item_id.required' => 'Data barang tidak boleh kosong',
            'quantity.required' => 'Jumlah barang masuk tidak boleh kosong'
        ];
    }
}
