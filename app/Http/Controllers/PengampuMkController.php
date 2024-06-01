<?php

namespace App\Http\Controllers;

use App\Interfaces\PengampuMkRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\PengampuMkResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PengampuMkController extends Controller
{
    private PengampuMkRepositoryInterface $pengampuMkRepositoryInterface;

    public function __construct(PengampuMkRepositoryInterface $pengampuMkRepositoryInterface)
    {
        $this->pengampuMkRepositoryInterface = $pengampuMkRepositoryInterface;
    }

    public function show()
    {
        $pengampu = $this->pengampuMkRepositoryInterface->getById();

        if ($pengampu->isEmpty()) {
            return ApiResponseClass::sendResponse('false', 'Pengampu not found', 404);
        }

        return ApiResponseClass::sendResponse($pengampu,'', 200);
    }

    public function showMatkul($id_matkul, $id_pengampu)
    {
        // // Mengambil data pengampu spesifik berdasarkan id_matkul dan id_pengampu
        // $data = $this->pengampuMkRepositoryInterface->getMatkulById($id_matkul, $id_pengampu);

        // // if ($data->isEmpty()) {
        // //     return ApiResponseClass::sendResponse('false', 'not found', 404);
        // // }

        // // Mengembalikan data dalam format JSON
        // // return response()->json($data);
        // return ApiResponseClass::sendResponse($data,'',200);

        DB::beginTransaction();
        try{
            $data = $this->pengampuMkRepositoryInterface->getMatkulById($id_matkul, $id_pengampu);

            DB::commit();
            return ApiResponseClass::sendResponse($data,'',201);
        } catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }
}