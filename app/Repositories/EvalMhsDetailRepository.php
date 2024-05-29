<?php

namespace App\Repositories;

use App\Interfaces\EvalMhsDetailRepositoryInterface;
use App\Models\Mahasiswa;

class EvalMhsDetailRepository implements EvalMhsDetailRepositoryInterface
{
    public function getEvalMhsDetailsByUserId($id)
    {
        return Mahasiswa::where('id_user', $id)
            ->with([
                'evaluasi_mhs.evaluasi',
                'evaluasi_mhs.cpl',
                'evaluasi_mhs.subcpmk',
                'evaluasi_mhs.detailRps'
            ])
            ->get()
            ->pluck('evaluasi_mhs')
            ->flatten();
    }
}
