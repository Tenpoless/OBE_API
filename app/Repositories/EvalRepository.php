<?php

namespace App\Repositories;

use App\Models\Evaluasi;
use App\Interfaces\EvalRepositoryInterface;

class EvalRepository implements EvalRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function index(){
        return Evaluasi::all();
    }

    public function getById($id_evaluasi){
        return Evaluasi::finOrFail($id_evaluasi);
    }

    public function store(array $data)
    {
        return Evaluasi::create($data);
    }
    public function update(array $data, $id_evaluasi){
        return Evaluasi::where('id_evaluasi', $id_evaluasi)->update($data);
    }

    public function delete($id_evaluasi){
        $evaluasi = Evaluasi::find($id_evaluasi);

        if (!$evaluasi) {
            return false; // Gagal menghapus karena evaluasi tidak ditemukan
        }
    
        $evaluasi->delete();
        return true;
    }
}
