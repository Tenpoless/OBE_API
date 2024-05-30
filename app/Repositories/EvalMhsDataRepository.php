<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Interfaces\EvalMhsDataRepositoryInterface;

class EvalMhsDataRepository implements EvalMhsDataRepositoryInterface
{
    public function tampil_evaluasi_mhs($id_matkul, $id_pengampu)
    {
        return DB::table('matkul_mhs')
            ->select('*')
            ->leftJoin('pengampu_mk', 'matkul_mhs.id_pengampu', '=', 'pengampu_mk.id_pengampu')
            ->leftJoin('matkul', 'pengampu_mk.id_matkul', '=', 'matkul.id_matkul')
            ->leftJoin('user', 'matkul_mhs.id_user', '=', 'user.id_user')
            ->leftJoin('mahasiswa', 'user.id_user', '=', 'mahasiswa.id_user')
            ->where('pengampu_mk.id_matkul', $id_matkul)
            ->where('pengampu_mk.id_pengampu', $id_pengampu)
            ->get();
    }
}
