<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiMahasiswa;
use App\Http\Requests\StoreEvaluasiMahasiswaRequest;
use App\Http\Requests\UpdateEvaluasiMahasiswaRequest;

class EvaluasiMahasiswaController extends Controller
{
    protected $evalMhsRepository;

    public function __construct(EvalMhsRepositoryInterface $evalMhsRepository) {
        $this->evalMhsRepository = $evalMhsRepository;
    }

    public function show(){
        $data = EvaluasiMahasiswa::all();
        return EvalMhsResource::collection($data);
    }
}
