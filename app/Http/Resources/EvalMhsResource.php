<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvalMhsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id_matkul' => $this->id_matkul,
            'nama_matkul' => $this->nama_matkul,
            'semester' => $this->semester,
            'kelas' => [
                'kelas_matkul' => $this->pengampu_mk ? $this->pengampu_mk->kelas : null
            ],
            'dosen' => [
                'nama_dosen' => $this->pengampu_mk && $this->pengampu_mk->dosen ? $this->pengampu_mk->dosen->nama_dosen : null
            ]
        ];
    }
}
