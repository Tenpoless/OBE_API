<?php 

namespace App\Repositories;

use App\Interfaces\PengampuMkRepositoryInterface;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\PengampuMk;
use Illuminate\Support\Facades\Auth;

class PengampuMkRepository implements PengampuMkRepositoryInterface
{
    public function getById()
    {
        //get id_user from login
        $user = Auth::user();
        $dosen = Dosen::where('id_user', $user->id_user)->firstOrFail();

        //get id_matkul and kelas from pengampu_mk
        // $pengampuMk = PengampuMk::where(['id_dosen', 'nama_dosen2', 'nama_dosen3'], $dosen->id_dosen)->get(['id_matkul', 'kelas']);
        $pengampuMk = PengampuMk::where('id_dosen', $dosen->id_dosen)
        ->orWhere('nama_dosen2', $dosen->id_dosen)
        ->orWhere('nama_dosen3', $dosen->id_dosen)
        ->get(['id_matkul', 'kelas']);

        //get matkul data 
        $matkulId = $pengampuMk->pluck('id_matkul');
        $matkuls = Matkul::whereIn('id_matkul', $matkulId)->get();

        //response
        $response = $matkuls->map(function ($matkul) use ($pengampuMk) {
            $kelas = $pengampuMk->firstWhere('id_matkul', $matkul->id_matkul)->kelas;
            return [
                'matkul' => $matkul,
                'kelas' => $kelas,
            ];
        });

        return $response;
    }
}