<?php

namespace App\Http\Requests\Aplikasi;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'nama_aplikasi' => 'required|string|min:3|max:100',
            'deskripsi_aplikasi' => 'required|string|min:3',
            'privacy_police_aplikasi' => 'required|string|min:3|max:6000',
            'gambar_aplikasi' => 'required|image|max:1024|mimes:jpg,jpeg,png',
        ];
    }
}
