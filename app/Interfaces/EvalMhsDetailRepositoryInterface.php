<?php

namespace App\Interfaces;

interface EvalMhsDetailRepositoryInterface
{
    public function findByUserId($id_user);
    public function hitung($nilai_mhs, $bobot);
    public function simpanHasil($id_user, $data);
}
