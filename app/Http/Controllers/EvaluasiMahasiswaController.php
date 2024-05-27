<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\EvalMhsResource;
use App\Interfaces\EvalMhsRepositoryInterface;
use Illuminate\Http\Request;

class EvaluasiMahasiswaController extends Controller
{
    protected $evalMhsRepository;

    public function __construct(EvalMhsRepositoryInterface $evalMhsRepository) {
        $this->evalMhsRepository = $evalMhsRepository;
    }

    public function show($id) {
        $data = $this->evalMhsRepository->findById($id);
        if ($data) {
            return new EvalMhsResource($data);
        }
        return response()->json(['message' => 'Data not found'], 404);
    }

    public function getMatkulByUser($userId) {
        $user = User::find($userId);
        if (!$user || !$user->dosen) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        
        // Ambil semua matkul yang terkait dengan dosen
        $matkuls = $user->dosen->matkuls;
        
        // Gunakan metode unique() untuk menghapus duplikasi berdasarkan id_matkul
        $uniqueMatkuls = $matkuls->unique('id_matkul');
        
        return EvalMhsResource::collection($uniqueMatkuls);
    }
}
