<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvalMhsDetailResource;
use App\Interfaces\EvalMhsDetailRepositoryInterface;
use Illuminate\Http\Request;
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

    // public function calculateBobotMhs($id_user, $id_evaluasimhs)
    // {
    //     $evaluasiMhs = $this->evalMhsDetailRepository->calculateAndUpdateBobotMhs($id_evaluasimhs);
    //     if (!$evaluasiMhs) {
    //         return response()->json(['error' => 'Evaluation not found'], 404);
    //     }
    //     return new EvalMhsDetailResource($evaluasiMhs);
    // }
}