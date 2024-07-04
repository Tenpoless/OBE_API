<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

}
