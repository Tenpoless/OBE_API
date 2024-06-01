<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvalMhsDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_cpl' => $this->id_cpl,
            'subcpmk' => $this->subcpmk,
            'asesmen' => $this->asesmen,
            'bobot' => $this->bobot,
            'nilai_mhs' => $this->nilai_mhs,
            'bobot_mhs' => $this->bobot_mhs,
        ];
    }
}
