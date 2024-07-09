<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEvaluasiMahasiswaDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_evaluasi' => 'required|numeric',
            'nilai_mhs' => 'required|numeric',
        ];
    }
}