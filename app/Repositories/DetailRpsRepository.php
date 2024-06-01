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
        $minggu = DB::table('detail_rps')
        ->select('minggu', 'id_matkul', 'id_detailrps', 'bobot')
        ->where('id_matkul', $id_matkul)
        ->get();

        return $minggu;
    }
}