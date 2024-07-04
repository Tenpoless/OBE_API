<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use Illuminate\Http\Request;
use App\Http\Resources\EvalMhsDetailResource;
use App\Repositories\EvalMhsDetailRepository;
use App\Interfaces\EvalMhsDetailRepositoryInterface;
use App\Models\EvaluasiMhs;
use App\Models\Evaluasi;
use App\Models\DetailRps;
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

    public function calculateEvaluasi($id_matkul, $id_user, $id_evaluasimhs, $id_pengampu)
    {
        $evaluasiMhs = EvaluasiMhs::where('id_evaluasimhs', $id_evaluasimhs)
        ->where('id_matkul', $id_matkul)
        ->where('id_user', $id_user)
        ->first();

        if (!$evaluasiMhs) {
            Log::error('Data evaluasi_mhs tidak ditemukan untuk id_matkul: ' . $id_matkul . ' dan id_user: ' . $id_user);
            return false;
        }

        $id_evaluasimhs = $evaluasiMhs->id_evaluasimhs;
        $nilai_mhs = $evaluasiMhs->nilai_mhs;
        $id_evaluasi2 = $evaluasiMhs->id_evaluasi2;

        $evaluasi = Evaluasi::find($id_evaluasi2);
        if (!$evaluasi) {
            Log::error('Data evaluasi tidak ditemukan untuk id_evaluasi2: ' . $id_evaluasi2);
            return false;
        }

        $id_detailrps = $evaluasi->id_detailrps;

        // Ambil kolom bobot dari tabel detail_rps
        $detailRps = DetailRps::find($id_detailrps);
        if (!$detailRps) {
            Log::error('Data detail_rps tidak ditemukan untuk id_detailrps: ' . $id_detailrps);
            return false;
        }

        $bobot = $detailRps->bobot;

        $result = $this->evalMhsDetailRepository->calculate($id_evaluasimhs, $nilai_mhs, $bobot);

        if (!$result) {
            Log::error('Update failed for id_evaluasimhs: ' . $id_evaluasimhs);
            return response()->json(['message' => 'Gagal'], 500);
        }

        // Berhasil, kembalikan data yang diperlukan
        return response()->json([
            'message' => 'Data Berhasil Diupdate !!',
            'nilai_mhs' => $result['nilai_mhs'],
            'bobot' => $result['bobot'],
            'bobot_mhs' => $result['bobot_mhs']
        ], 200);
    }
}