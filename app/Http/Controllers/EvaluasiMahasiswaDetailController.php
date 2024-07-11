<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes\ApiResponseClass;
use App\Http\Resources\EvalMhsDetailResource;
use App\Repositories\EvalMhsDetailRepository;
use App\Interfaces\EvalMhsDetailRepositoryInterface;
use App\Http\Requests\StoreEvaluasiMahasiswaDetailRequest;
use App\Http\Requests\UpdateEvaluasiMahasiswaDetailRequest;
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

    public function store(StoreEvaluasiMahasiswaDetailRequest $request, $id_user, $id_matkul)
    {
        $data = $request->only(['id_evaluasi', 'nilai_mhs']);
        $data['id_user'] = $id_user;
        $data['id_matkul'] = $id_matkul;

        $result = $this->evalMhsDetailRepository->insertNilai($data);

        if ($result) {
            return response()->json(['message' => 'Data created successfully'], 201);
        } else {
            return response()->json(['error' => 'Failed to create data. Check application logs for details.'], 500);
        }
    }

    public function update(UpdateEvaluasiMahasiswaDetailRequest $request, $id_user, $id_matkul, $id_evaluasimhs)
    {
        $data = $request->only(['id_evaluasi', 'nilai_mhs']);
        
        $update = $this->evalMhsDetailRepository->updateNilai($id_evaluasimhs, $data);

        if ($update) {
            return response()->json(['message' => 'Data updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to update data. Check application logs for details.'], 500);
        }
    }

    public function destroy($id_user, $id_matkul, $id_evaluasimhs)
    {
        $delete = $this->evalMhsDetailRepository->deleteNilai($id_evaluasimhs);

        if ($delete) {
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to delete data. Check application logs for details.'], 500);
        }
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
