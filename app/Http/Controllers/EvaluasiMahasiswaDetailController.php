<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use Illuminate\Http\Request;
use App\Http\Resources\EvalMhsDetailResource;
use App\Repositories\EvalMhsDetailRepository;
use App\Interfaces\EvalMhsDetailRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EvaluasiMahasiswaDetailController extends Controller
{
    protected $evalMhsDetailRepository;

    public function __construct(EvalMhsDetailRepositoryInterface $evalMhsDetailRepository)
    {
        $this->evalMhsDetailRepository = $evalMhsDetailRepository;
    }

    public function getByUserId($id_user)
    {
        $details = $this->evalMhsDetailRepository->getDetailsByUserId($id_user);
        if ($details->isEmpty()) {
            return response()->json(['error' => 'Details not found'], 404);
        }
        return EvalMhsDetailResource::collection($details);
    }

    public function getByMatkulId($id_matkul)
    {
        $details = $this->evalMhsDetailRepository->getDetailsByMatkulId($id_matkul);
        if ($details->isEmpty()) {
            return response()->json(['error' => 'Details not found'], 404);
        }
        return EvalMhsDetailResource::collection($details);
    }

    public function calculateEvaluasi(Request $request, $id_matkul, $id_user, $id_pengampu)
    {
        $id_evaluasimhs = $request->input('id_evaluasimhs');
        $nilai_mhs = $request->input('nilai_mhs');
        $bobot = $request->input('bobot');

        if (!$id_evaluasimhs || !$nilai_mhs || !$bobot) {
            Log::error('Invalid input data', ['id_evaluasimhs' => $id_evaluasimhs, 'nilai_mhs' => $nilai_mhs, 'bobot' => $bobot]);
            return response()->json(['message' => 'Invalid input data'], 400);
        }

        $result = $this->evalMhsDetailRepository->calculate($id_evaluasimhs, $nilai_mhs, $bobot);

        if ($result) {
            return response()->json(['message' => 'Data Berhasil Diupdate !!'], 200);
        } else {
            Log::error('Update failed for id_evaluasimhs: ' . $id_evaluasimhs);
            return response()->json(['message' => 'Gagal'], 500);
        }
    }
}