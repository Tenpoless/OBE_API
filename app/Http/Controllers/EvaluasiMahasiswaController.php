<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EvalMhsResource;
use App\Interfaces\EvalMhsRepositoryInterface;

class EvaluasiMahasiswaController extends Controller
{
    protected $evalMhsRepository;

    public function __construct(EvalMhsRepositoryInterface $evalMhsRepository)
    {
        $this->evalMhsRepository = $evalMhsRepository;
    }

    // Mengambil data evaluasi mahasiswa berdasarkan id matkul
    public function show($id_matkul)
    {
        try {
            $data = $this->evalMhsRepository->findByMatkulId($id_matkul);

            // Jika data ditemukan, kembalikan sebagai JSON resource
            if ($data) {
                return new EvalMhsResource($data);
            }

            // Jika tidak ditemukan, kembalikan response JSON dengan status 404
            return response()->json(['message' => 'Data not found'], 404);
        } catch (\Exception $e) {
            // Tangani exception dengan mengembalikan response JSON dengan status 500 (Internal Server Error)
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}
