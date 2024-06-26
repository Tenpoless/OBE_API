<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvalMhsDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'kode_cpl' => $this->whenNotNull($this->kode_cpl, 'N/A'),
            'subcpmk' => $this->whenNotNull($this->subcpmk, 'N/A'),
            'asesmen' => $this->whenNotNull($this->asesmen, 'N/A'),
            'bobot' => $this->whenNotNull($this->bobot, 'N/A'),
            'nilai_mhs' => $this->whenNotNull($this->nilai_mhs, 'N/A'),
            'bobot_mhs' => $this->whenNotNull($this->bobot_mhs, 'N/A'),
            'id_evaluasimhs' => $this->whenNotNull($this->id_evaluasimhs, 'N/A'),
        ];
    }
}
