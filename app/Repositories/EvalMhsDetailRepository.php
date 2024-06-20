<?php

namespace App\Repositories;

use App\Interfaces\EvalMhsDetailRepositoryInterface;
use App\Models\Cpl;
use App\Models\EvaluasiMhs;
use Illuminate\Support\Facades\Log;

class EvalMhsDetailRepository implements EvalMhsDetailRepositoryInterface
{
    public function getDetailsByUserId($id_user)
    {
        $details = Cpl::join('subcpmk', 'cpl.id_cpl', '=', 'subcpmk.id_cplmk')
            ->join('detail_rps', 'subcpmk.id_subcpmk', '=', 'detail_rps.id_subcpmk')
            ->join('evaluasi', 'detail_rps.id_detailrps', '=', 'evaluasi.id_detailrps')
            ->join('evaluasi_mhs', 'evaluasi.id_evaluasi', '=', 'evaluasi_mhs.id_evaluasi2')
            ->where('evaluasi_mhs.id_user', $id_user)
            ->select(
                'evaluasi_mhs.id_evaluasimhs', 
                'detail_rps.minggu', 
                'cpl.kode_cpl', 
                'subcpmk.subcpmk', 
                'evaluasi.asesmen', 
                'detail_rps.bobot', 
                'evaluasi_mhs.nilai_mhs', 
                'evaluasi_mhs.bobot_mhs')
            ->get();

        Log::info('User ID: ' . $id_user);
        Log::info('Details: ', $details->toArray());

        return $details;
    }

    public function calculateAndUpdateBobotMhs($id_evaluasimhs)
    {
        $evaluasiMhs = EvaluasiMhs::find($id_evaluasimhs);
        if (!$evaluasiMhs) {
            return null;
        }

        $bobot = $evaluasiMhs->detailRps->bobot;
        $nilaiMhs = $evaluasiMhs->nilai_mhs;

        $bobotMhs = ($bobot * $nilaiMhs) / 100;
        $evaluasiMhs->bobot_mhs = $bobotMhs;
        $evaluasiMhs->save();

        return $evaluasiMhs;
    }
}
