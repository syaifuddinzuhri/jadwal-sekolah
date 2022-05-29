<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMapelRequest extends FormRequest
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
            'tahun_akademik_id' => 'required',
            'kelas_id' => 'required',
            'kode_mapel' => 'required|unique:mata_pelajarans,kode_mapel,NULL',
            'nama_mapel' => 'required',
            'total_jam' => 'required',
            'start' => 'required',
            'end' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tahun_akademik_id.required' => 'Tahun akademik harus diisi.',
            'kelas_id.required' => 'Kelas harus diisi.',
            'kode_mapel.required' => 'Kode mapel harus diisi.',
            'kode_mapel.unique' => 'Kode mapel sudah digunakan.',
            'nama_mapel.required' => 'Nama mapel harus diisi.',
            'total_jam.required' => 'Total jam harus diisi.',
            'start.required' => 'Jam mulai harus diisi.',
            'end.required' => 'Jam selesai harus diisi.',
        ];
    }
}
