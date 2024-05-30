<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EvalMhsResource;
use App\Interfaces\EvalMhsRepositoryInterface;

class EvaluasiMahasiswaController extends Controller
{
    public function show() {
        $user = Auth::user();
        $data = $this->evalMhsRepository->findById($user->id_user);  // Use the correct key name
        if ($data) {
            return new EvalMhsResource($data);
        }
        return response()->json(['message' => 'Data not found'], 404);
    }

    public function getMatkulByUser() {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        $dosen = $user->dosen;
        if (!$dosen) {
            return response()->json(['message' => 'Dosen not found'], 404);
        }

        $matkuls = $dosen->matkul;
        if (!$matkuls) {
            return response()->json(['message' => 'Matkul not found'], 404);
        }

        // Gunakan metode unique() untuk menghapus duplikasi berdasarkan id_matkul
        $uniqueMatkuls = $matkuls->unique('id_matkul');
        
        return EvalMhsResource::collection($uniqueMatkuls);
    }
}
