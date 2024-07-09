<?php

namespace App\Repositories;

use App\Interfaces\DetailRpsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\DetailRps;

class DetailRpsRepository implements DetailRpsRepositoryInterface 
{
    public function index()
    {
        return DetailRps::all();
    }
    public function getDetailRpsById($id_detailrps)
    {
        return DetailRps::findOrFail($id_detailrps);
    }

    public function getMingguByIdMatkul($id_matkul)
    {

        dd($id_matkul);
        
        $minggu = DB::table('evaluasi')
        ->select(
            'detail_rps.minggu', 
            'detail_rps.id_matkul', 
            'detail_rps.id_detailrps',
            'evaluasi.id_evaluasi' // Menambahkan kolom id_evaluasi
        )
        ->leftJoin('detail_rps', 'evaluasi.id_detailrps', '=', 'detail_rps.id_detailrps')
        ->leftJoin('subcpmk', 'detail_rps.id_subcpmk', '=', 'subcpmk.id_subcpmk')
        ->where('evaluasi.id_matkul', $id_matkul)
        ->get();

        $minggu = $minggu->sort(function($a, $b) {
            $a_parts = explode('-', $a->minggu);
            $b_parts = explode('-', $b->minggu);
            $a_start = intval($a_parts[0]);
            $b_start = intval($b_parts[0]);
    
            if ($a_start == $b_start) {
                if (isset($a_parts[1]) && isset($b_parts[1])) {
                    return intval($a_parts[1]) - intval($b_parts[1]);
                }
                return 0;
            }
            return $a_start - $b_start;
        });
    
        return $minggu->values();
    }

    public function deleteEvaluasi($id_detailrps, $id_evaluasi)
    {
        
    }
}