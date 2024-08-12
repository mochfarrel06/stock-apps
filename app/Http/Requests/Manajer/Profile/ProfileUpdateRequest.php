<?php

namespace App\Http\Requests\Manajer\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'avatar' => ['nullable', 'image', 'max:1000', 'mimes:png,jpg,jpeg'],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:200', 'unique:users,email,' . auth()->user()->id],
            'username' => ['required', 'string', 'unique:users,username,' . auth()->user()->id]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah di tambahkan',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah di tambahkan',
            'avatar.image' => 'File harus berupa gambar',
            'avatar.max' => 'Ukuran gambar tidak boleh lebih dari 1000 KB',
            'avatar.mimes' => 'Format gambar harus berupa PNG, JPG, atau JPEG'
        ];
    }
}
