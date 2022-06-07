<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'no_hp' => 'required',
            'nisn' => 'required',
            'jenis_kelamin' => 'required',
            'kelas_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'kelas_id.required' => 'Kelas harus diisi.',
            'nama_lengkap.required' => 'Nama harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tgl_lahir.required' => 'Tanggal lahir harus diisi.',
            'no_hp.required' => 'Nomor HP/WA harus diisi.',
            'nisn.required' => 'NISN harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
        ];
    }
}
