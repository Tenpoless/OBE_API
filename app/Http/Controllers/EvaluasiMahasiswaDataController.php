<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\EvalMhsDataResource;
use Illuminate\Http\Request;

class EvaluasiMahasiswaDataController extends Controller
{
    public function getMahasiswaByDosen($userId)
    {
        // Memuat data dosen beserta relasi pengampu_mk -> matkul_mhs -> mahasiswa
        $user = User::with('dosen.pengampu_mk.matkulMhs.mahasiswa')->find($userId);

        if (!$user || !$user->dosen) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Mengambil data matkul_mhs melalui relasi pengampu_mk dari dosen yang bersangkutan
        $matkulMhs = $user->dosen->pengampu_mk->flatMap(function ($pengampuMK) {
            return $pengampuMK->matkulMhs;
        });

        // Menghapus duplikasi berdasarkan id_user
        $uniqueMatkulMhs = $matkulMhs->unique('id_user');

        return EvalMhsDataResource::collection($uniqueMatkulMhs);
    }
}
