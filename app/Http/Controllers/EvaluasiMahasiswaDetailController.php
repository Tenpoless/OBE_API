<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EvalMhsDetailResource;
use App\Interfaces\EvalMhsDetailRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EvaluasiMahasiswaDetailController extends Controller
{
    protected $evalMhsDetailRepository;

    public function __construct(EvalMhsDetailRepositoryInterface $evalMhsDetailRepository)
    {
        $this->evalMhsDetailRepository = $evalMhsDetailRepository;
    }

    public function show($id_user)
    {
        try {
            $evaluasiMhsDetail = $this->evalMhsDetailRepository->findByUserId($id_user);
            return EvalMhsDetailResource::collection($evaluasiMhsDetail);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
}
