<?php

namespace App\Http\Controllers;

use App\Models\HalamanUtama;
use App\Classes\ApiResponseClass;
use App\Http\Resources\HalamanUtamaResource;
use App\Interfaces\HalUtamaRepositoryInterface;
use Illuminate\Http\Request;

class HalamanUtamaController extends Controller
{
    private HalUtamaRepositoryInterface $halUtamaRepository;

    public function __construct(HalUtamaRepositoryInterface $halUtamaRepository)
    {
        $this->halUtamaRepository = $halUtamaRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data dari repository
        $data = $this->halUtamaRepository->getAll();

        // Menggunakan ApiResponseClass untuk mengirim respons dengan data yang diambil
        return ApiResponseClass::sendResponse(HalamanUtamaResource::collection($data), '', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data berdasarkan id dari repository
        $data = $this->halUtamaRepository->getById($id);

        // Menggunakan ApiResponseClass untuk mengirim respons dengan data yang diambil
        return ApiResponseClass::sendResponse(new HalamanUtamaResource($data), '', 200);
    }

    // Metode lainnya bisa dihapus atau dibiarkan kosong jika tidak diperlukan
    public function create()
    {
        //
    }

    public function store(StoreHalamanUtamaRequest $request)
    {
        //
    }

    public function edit(HalamanUtama $halamanUtama)
    {
        //
    }

    public function update(UpdateHalamanUtamaRequest $request, HalamanUtama $halamanUtama)
    {
        //
    }

    public function destroy(HalamanUtama $halamanUtama)
    {
        //
    }
}
