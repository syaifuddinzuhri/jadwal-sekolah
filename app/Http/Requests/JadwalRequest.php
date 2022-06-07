<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalRequest extends FormRequest
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
            'kelas_id' => 'required',
            'tahun_akademik_id' => 'required',
            'mata_pelajaran_id' => 'required',
            'day_id' => 'required',
            'urutan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'kelas_id.required' => 'Kelas harus diisi.',
            'mata_pelajaran_id.required' => 'Mata pelajaran harus diisi.',
            'day_id.required' => 'Hari harus diisi.',
            'tahun_akademik_id.required' => 'Tahun akademik harus diisi.',
            'urutan.required' => 'Urutan harus diisi.',
        ];
    }
}
