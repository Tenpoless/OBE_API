<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengampuMkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_matkul' => $this->id_matkul,
            'matkul' => $this->matkul,
            'jurusan' => $this->matkul->jurusan,
            'fakultas' => $this->matkul->jurusan->fakultas,
            'deskripsi_mk' => $this->matkul->deskripsiMk,
            'dosen' => $this->dosen,
        ];
    }
}
