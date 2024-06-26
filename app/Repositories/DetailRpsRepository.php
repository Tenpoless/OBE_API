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
        ->select('detail_rps.minggu', 'detail_rps.id_matkul', 'detail_rps.id_detailrps')
        ->leftJoin('detail_rps', 'evaluasi.id_detailrps', '=', 'detail_rps.id_detailrps')
        ->leftJoin('subcpmk', 'detail_rps.id_subcpmk', '=', 'subcpmk.id_subcpmk')
        ->where('evaluasi.id_matkul', $id_matkul)
        ->get();

        return $minggu;
    }

    public function deleteEvaluasi($id_detailrps, $id_evaluasi)
    {
        
    }
}

        // $minggu = DB::table('detail_rps')
        // ->select('minggu', 'id_matkul', 'id_detailrps', 'bobot')
        // ->where('id_matkul', $id_matkul)
        // ->get();

        // $minggu = DB::table('evaluasi')
        // ->select('detail_rps.minggu')
        // ->leftJoin('detail_rps', 'evaluasi.id_detailrps', '=', 'detail_rps.id_detailrps')
        // ->leftJoin('subcpmk', 'detail_rps.id_subcpmk', '=', 'subcpmk.id_subcpmk')
        // ->where('evaluasi.id_matkul', $id_matkul)
        // ->get();