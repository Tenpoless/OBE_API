<?php

namespace App\Http\Controllers;

use App\Interfaces\PengampuMkRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\PengampuMkResource;
use Illuminate\Support\Facades\Auth;


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
}