<?php

namespace App\Repositories;

use App\Models\EvaluasiMhs;
use App\Interfaces\EvalMhsDetailRepositoryInterface;

class EvalMhsDetailRepository implements EvalMhsDetailRepositoryInterface
{
    public function findByUserId($id_user)
    {
        return EvaluasiMhs::where('id_user', $id_user)
            ->with(['cpl', 'subcpmk', 'evaluasi.detailRps'])
            ->get();
    }

    public function hitung($nilai_mhs, $bobot)
    {
        $hasil = $nilai_mhs * $bobot;
        $hasil2 = $hasil / 100;
        return ['hasil' => $hasil, 'hasil2' => $hasil2];
    }

    public function simpanHasil($id_user, $data)
    {
        foreach ($data as $item) {
            $evaluasi = EvaluasiMhs::where('id_user', $id_user)
                ->where('id_matkul', $item['id_matkul'])
                ->where('id_cplmk', $item['id_cplmk'])
                ->where('id_pengampu', $item['id_pengampu'])
                ->first();

            if ($evaluasi) {
                // Update existing record
                $evaluasi->update([
                    'nilai_matkul_cpl' => $item['nilai_matkul_cpl'],
                    'hasil' => $item['hasil'],
                    'hasil2' => $item['hasil2']
                ]);
            } else {
                // Create new record
                EvaluasiMhs::create([
                    'id_user' => $id_user,
                    'id_jurusan' => $item['id_jurusan'],
                    'id_matkul' => $item['id_matkul'],
                    'id_cplmk' => $item['id_cplmk'],
                    'id_pengampu' => $item['id_pengampu'],
                    'nilai_matkul_cpl' => $item['nilai_matkul_cpl'],
                    'hasil' => $item['hasil'],
                    'hasil2' => $item['hasil2']
                ]);
            }
        }

        return true;
    }
}
