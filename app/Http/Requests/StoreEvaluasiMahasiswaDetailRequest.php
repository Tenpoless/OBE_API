<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluasiMahasiswaDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ubah menjadi 'true' jika Anda ingin memungkinkan permintaan untuk diproses.
    }

    public function rules()
    {
        return [
            'nilai_mhs' => 'required|numeric',
            'bobot' => 'required|numeric'
            // Tentukan aturan validasi tambahan jika diperlukan untuk operasi pembuatan entitas baru.
        ];
    }
}
