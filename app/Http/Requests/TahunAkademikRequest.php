<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TahunAkademikRequest extends FormRequest
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
            'tahun_1' => 'required',
            'tahun_2' => 'required',
            'semester' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tahun_1.required' => 'Tahun awal harus diisi.',
            'tahun_2.required' => 'Tahun akhir harus diisi.',
            'semester.required' => 'Semester harus diisi.',
        ];
    }
}
