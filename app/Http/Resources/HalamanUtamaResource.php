<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HalamanUtamaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_dosen'      => $this->id_dosen,
            'nip'           => $this->nip,
            'nama_dosen'    => $this->nama_dosen,
            'tempat_lahir'  => $this->tempat_lahir,
            'alamat'        => $this->alamat,
            'no_telpon'     => $this->no_telpon,
            'email'         => $this->email
        ];
    }
}
