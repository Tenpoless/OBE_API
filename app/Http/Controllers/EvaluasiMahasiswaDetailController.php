<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EvalMhsDetailResource;
use App\Interfaces\EvalMhsDetailRepositoryInterface;
use App\Http\Requests\StoreEvaluasiMahasiswaDetailRequest;
use App\Http\Requests\UpdateEvaluasiMahasiswaDetailRequest;

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

    public function hitungByUserId(StoreEvaluasiMahasiswaDetailRequest $request, $id_user)
    {
        // Validasi input
        $validatedData = $request->validated();

        try {
            $evaluasiMhsDetails = $this->evalMhsDetailRepository->findByUserId($id_user);
            $data = [];

            // Hitung hasil untuk setiap detail evaluasi dan persiapkan data untuk disimpan
            foreach ($evaluasiMhsDetails as $detail) {
                $hasil = $this->evalMhsDetailRepository->hitung($detail->nilai_mhs, $detail->bobot_mhs);
                $detail->hasil = $hasil['hasil'];
                $detail->hasil2 = $hasil['hasil2'];

                $data[] = [
                    'id_jurusan' => $detail->id_jurusan,
                    'id_matkul' => $detail->id_matkul,
                    'id_cplmk' => $detail->id_cplmk,
                    'id_pengampu' => $detail->id_pengampu,
                    'nilai_matkul_cpl' => $detail->nilai_matkul_cpl,
                    'hasil' => $detail->hasil,
                    'hasil2' => $detail->hasil2
                ];
            }

            // Simpan hasil perhitungan
            $updated = $this->evalMhsDetailRepository->simpanHasil($id_user, $data);

            $message = $updated ? "Data telah diperbarui." : "Data baru telah ditambahkan.";

            return response()->json(['message' => $message, 'details' => EvalMhsDetailResource::collection($evaluasiMhsDetails)], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
