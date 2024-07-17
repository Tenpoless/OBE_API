<?php

namespace App\Repositories;

use App\Models\EvaluasiMhs;
use App\Interfaces\EvalMhsDetailRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Evaluasi;
use Illuminate\Support\Facades\Validator;
use App\Models\Cpl;
use App\Models\DetailRps;
use App\Models\SubCpmk;
use Illuminate\Support\Facades\Log;

class EvalMhsDetailRepository implements EvalMhsDetailRepositoryInterface
{
    public function getDetailsByUserId($id_user)
    {
        $details = Cpl::join('subcpmk', 'cpl.id_cpl', '=', 'subcpmk.id_cplmk')
            ->join('detail_rps', 'subcpmk.id_subcpmk', '=', 'detail_rps.id_subcpmk')
            ->join('evaluasi', 'detail_rps.id_detailrps', '=', 'evaluasi.id_detailrps')
            ->join('matkul', 'matkul.id_matkul', '=', 'detail_rps.id_matkul')
            ->join('evaluasi_mhs', 'evaluasi.id_evaluasi', '=', 'evaluasi_mhs.id_evaluasi2')
            ->where('evaluasi_mhs.id_user', $id_user)
            ->select(
                'matkul.id_matkul',
                'detail_rps.id_detailrps',
                'evaluasi_mhs.id_evaluasimhs',
                'detail_rps.minggu',
                'cpl.kode_cpl',
                'subcpmk.subcpmk',
                'evaluasi.asesmen',
                'detail_rps.bobot',
                'evaluasi_mhs.nilai_mhs',
                'evaluasi_mhs.bobot_mhs'
            )
            ->get();

        return $details;
    }

    public function insertNilai($data)
    {
        try {
            $evaluasiMhs = new EvaluasiMhs();
            $evaluasiMhs->id_user = $data['id_user'];
            $evaluasiMhs->id_evaluasi2 = $data['id_evaluasi'];
            $evaluasiMhs->id_matkul = $data['id_matkul'];
            $evaluasiMhs->nilai_mhs = $data['nilai_mhs'];
            $evaluasiMhs->bobot_mhs = isset($data['bobot_mhs']) ? $data['bobot_mhs'] : 0;

            $evaluasiMhs->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to insert nilai mahasiswa: ' . $e->getMessage());
            return false;
        }
    }

    public function updateNilai($id_evaluasimhs, $data)
    {
        $evaluasiMhs = EvaluasiMhs::find($id_evaluasimhs);
        
        if (!$evaluasiMhs) {
            Log::error('Failed to update nilai mahasiswa: EvaluasiMhs not found for id_evaluasimhs ' . $id_evaluasimhs);
            return false;
        }

        $evaluasiMhs->id_evaluasi2 = $data['id_evaluasi'];
        $evaluasiMhs->nilai_mhs = $data['nilai_mhs'];
        $evaluasiMhs->bobot_mhs = isset($data['bobot_mhs']) ? $data['bobot_mhs'] : 0;
        
        try {
            $evaluasiMhs->save();
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to update nilai mahasiswa: ' . $e->getMessage(), ['exception' => $e]);
            return false;
        }
    }

    

    public function deleteNilai($id_evaluasimhs)
    {
        $evaluasiMhs = EvaluasiMhs::find($id_evaluasimhs);

        if (!$evaluasiMhs) {
            return false; // Data tidak ditemukan
        }

        try {
            return $evaluasiMhs->delete();
        } catch (\Exception $e) {
            Log::error('Failed to delete nilai mahasiswa: ' . $e->getMessage());
            return false;
        }
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

    public function getDetailsByMatkulId($id_matkul)
    {
        $details = Cpl::join('subcpmk', 'cpl.id_cpl', '=', 'subcpmk.id_cplmk')
            ->join('detail_rps', 'subcpmk.id_subcpmk', '=', 'detail_rps.id_subcpmk')
            ->join('evaluasi', 'detail_rps.id_detailrps', '=', 'evaluasi.id_detailrps')
            ->join('matkul', 'matkul.id_matkul', '=', 'detail_rps.id_matkul')
            ->join('evaluasi_mhs', 'evaluasi.id_evaluasi', '=', 'evaluasi_mhs.id_evaluasi2')
            ->where('matkul.id_matkul', $id_matkul)
            ->select(
                'matkul.id_matkul',
                'detail_rps.id_detailrps',
                'evaluasi_mhs.id_evaluasimhs',
                'detail_rps.minggu',
                'cpl.kode_cpl',
                'subcpmk.subcpmk',
                'evaluasi.asesmen',
                'detail_rps.bobot',
                'evaluasi_mhs.nilai_mhs',
                'evaluasi_mhs.bobot_mhs'
            )
            ->get();

        return $details;
    }
}
