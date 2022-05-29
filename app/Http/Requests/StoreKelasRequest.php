<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKelasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jurusan_id' => 'required',
            'tingkat' => 'required',
            'nama' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'jurusan_id.required' => 'Jurusan harus diisi.',
            'tingkat.required' => 'Tingkat kelas harus diisi.',
            'nama.required' => 'Nama kelas harus diisi.',
        ];
    }
}
