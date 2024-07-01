<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface EvalMhsDetailRepositoryInterface
{
    public function getDetailsByUserId($id_user);
    public function getDetailsByMatkulId($id_matkul);
    public function calculate($id_evaluasimhs, $nilai_mhs, $bobot);
}
