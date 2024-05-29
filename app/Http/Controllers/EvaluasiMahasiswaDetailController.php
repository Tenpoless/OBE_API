<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvalMhsDetailResource;
use App\Interfaces\EvalMhsDetailRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EvaluasiMahasiswaDetailController extends Controller
{
    protected $evalMhsDetailRepository;

    public function __construct(EvalMhsDetailRepositoryInterface $evalMhsDetailRepository)
    {
        $this->evalMhsDetailRepository = $evalMhsDetailRepository;
    }

    public function getEvaluasiDetailsByUserId($id)
    {
        try {
            $evaluasiDetails = $this->evalMhsDetailRepository->getEvalMhsDetailsByUserId($id);
            if ($evaluasiDetails->isEmpty()) {
                return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
            }
            return response()->json(EvalMhsDetailResource::collection($evaluasiDetails), Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Error fetching evaluasi details: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
