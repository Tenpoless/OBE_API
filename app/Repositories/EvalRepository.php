<?php

namespace App\Repositories;

use App\Models\Evaluasi;
use App\Models\DetailRps;
use App\Interfaces\EvalRepositoryInterface;

class EvalRepository implements EvalRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function index(){
        return Evaluasi::all();
    }

    public function getById($id_detailrps){
        $detailrps = DetailRps::findOrFail($id_detailrps);

        $evaluasi = Evaluasi::where('id_detailrps', $detailrps->id_detailrps)->first();

        return $evaluasi;
    }

    public function store(array $data)
    {
        return Evaluasi::create($data);
    }
    
    public function update(array $data, $id_evaluasi)
    {
        return Evaluasi::where('id_evaluasi', $id_evaluasi)->update($data);
    }

    public function delete($id_evaluasi,$id_matkul,  $id_pengampu)
    {
        $evaluasi = Evaluasi::find($id_evaluasi);

        if (!$evaluasi) {
            return false; // Gagal menghapus karena evaluasi tidak ditemukan
        }
    
        $evaluasi->delete();
        return true;
    }
}
