<?php

namespace App\Repositories;

use App\Interfaces\MatkulCplRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MatkulCplRepository implements MatkulCplRepositoryInterface
{
    public function getMatkulCplByUserId($userId)
    {
        return DB::table('user')
            ->join('dosen', 'user.id_user', '=', 'dosen.id_user')
            ->join('jurusan', 'dosen.id_jurusan', '=', 'jurusan.id_jurusan')
            ->join('matkul', 'jurusan.id_jurusan', '=', 'matkul.id_jurusan')
            ->join('pengampu_mk', 'matkul.id_matkul', '=', 'pengampu_mk.id_matkul')
            ->join('cpl', 'jurusan.id_jurusan', '=', 'cpl.id_jurusan') // Sesuaikan relasi ini
            ->where('user.id_user', $userId)
            ->select('matkul.nama_matkul', 'pengampu_mk.kelas', 'cpl.kode_cpl')
            ->get();
    }
}
