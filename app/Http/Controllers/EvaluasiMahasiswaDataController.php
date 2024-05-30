<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\EvalMhsDataResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk menggunakan Auth

class EvaluasiMahasiswaDataController extends Controller
{
    public function getMahasiswaByMatkul($id_matkul)
    {
        // Dapatkan ID pengguna yang terotentikasi
        $userId = Auth::id();

        // Memuat data dosen beserta relasi pengampu_mk -> matkul_mhs -> mahasiswa
        $user = User::with('dosen.pengampu_mk.matkulMhs.mahasiswa')->find($userId);

        if (!$user || !$user->dosen) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        // Filter data matkul_mhs berdasarkan id_matkul
        $matkulMhs = $user->dosen->pengampu_mk
            ->where('id_matkul', $id_matkul)
            ->flatMap(function ($pengampuMK) {
                return $pengampuMK->matkulMhs;
            });

        // Mengambil data mahasiswa dari hasil filter
        $mahasiswa = $matkulMhs->map(function ($matkulMhs) {
            return $matkulMhs->mahasiswa;
        });

        return EvalMhsDataResource::collection($mahasiswa);
    }
}