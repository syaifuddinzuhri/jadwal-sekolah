<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuruRequest extends FormRequest
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
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'no_hp' => 'required',
            'provinsi' => 'required',
            'kab_kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tgl_lahir.required' => 'Tanggal lahir harus diisi.',
            'no_hp.required' => 'Nomor HP/WA harus diisi.',
            'provinsi.required' => 'Provinsi harus diisi.',
            'kab_kota.required' => 'Kabupaten/Kota harus diisi.',
            'kecamatan.required' => 'Kecamatan harus diisi.',
            'desa.required' => 'Desa/Kelurahan harus diisi.',
        ];
    }
}
