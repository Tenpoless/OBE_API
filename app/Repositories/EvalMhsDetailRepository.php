<?php

namespace App\Repositories;

use App\Models\EvaluasiMhs;
use App\Interfaces\EvalMhsDetailRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Evaluasi;
use Illuminate\Support\Facades\Validator;
use App\Models\Cpl;
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
            ->select('cpl.kode_cpl', 'subcpmk.subcpmk', 'evaluasi.asesmen', 'detail_rps.bobot', 'evaluasi_mhs.nilai_mhs', 'evaluasi_mhs.id_evaluasimhs', 'evaluasi_mhs.bobot_mhs')
            ->get();

        return $details;
    }

    public function getDetailsByMatkulId($id_matkul)
    {
        $details = Cpl::join('subcpmk', 'cpl.id_cpl', '=', 'subcpmk.id_cplmk')
            ->join('detail_rps', 'subcpmk.id_subcpmk', '=', 'detail_rps.id_subcpmk')
            ->join('evaluasi', 'detail_rps.id_detailrps', '=', 'evaluasi.id_detailrps')
            ->join('evaluasi_mhs', 'evaluasi.id_evaluasi', '=', 'evaluasi_mhs.id_evaluasi2')
            ->where('detail_rps.id_matkul', $id_matkul)
            ->select('cpl.kode_cpl', 'subcpmk.subcpmk', 'evaluasi.asesmen', 'detail_rps.bobot', 'evaluasi_mhs.nilai_mhs')
            ->get();

        Log::info('Matkul ID: ' . $id_matkul);
        Log::info('Details: ', $details->toArray());

        return $details;
    }

    public function calculate($id_evaluasimhs, $nilai_mhs, $bobot)
    {
        $hasil = $nilai_mhs * $bobot;
        $hasil2 = $hasil / 100;

        $data = [
            'bobot_mhs' => $hasil2
        ];

        Log::info('Hasil perhitungan: ' . $hasil2);
        Log::info('Data yang akan diupdate: ', $data);

        $evaluasi = EvaluasiMhs::find($id_evaluasimhs);
        if (!$evaluasi) {
            Log::error('Data evaluasi tidak ditemukan untuk id: ' . $id_evaluasimhs);
            return false;
        }

        $updateResult = $evaluasi->update($data);
        Log::info('Hasil update: ' . $updateResult);

        if ($updateResult) {
            return [
                'nilai_mhs' => $nilai_mhs,
                'bobot' => $bobot,
                'bobot_mhs' => $hasil2
            ];
        }

        return false;
    }
}
