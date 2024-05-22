<?php

namespace App\Http\Controllers;

use App\Interfaces\HalUtamaRepositoryInterface;
use App\Http\Resources\HalamanUtamaResource;
use App\Http\Resources\ProfileDosenResource;
use Illuminate\Http\Request;

class HalamanUtamaController extends Controller
{
    protected $halUtamaRepository;

    public function __construct(HalUtamaRepositoryInterface $halUtamaRepository)
    {
        $this->halUtamaRepository = $halUtamaRepository;
    }

    /**
     * Menampilkan nama dosen berdasarkan user_id.
     */
    public function getNamaDosen($id)
    {
        try {
            $user = $this->halUtamaRepository->getNamaDosen($id);
            return new HalamanUtamaResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }

    /**
     * Menampilkan nama dosen, email, dan nomor telepon berdasarkan user_id.
     */
    public function getProfileDosen($id)
    {
        try {
            $user = $this->halUtamaRepository->getProfileDosen($id);
            return new ProfileDosenResource($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
}
