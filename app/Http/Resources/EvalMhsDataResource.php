<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvalMhsDataResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_user' => $this->mahasiswa->id_user,
            'nama_mhs' => $this->mahasiswa->nama_mhs,
            'npm' => $this->mahasiswa->npm,
        ];
    }
}