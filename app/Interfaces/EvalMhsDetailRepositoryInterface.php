<?php

namespace App\Interfaces;

interface EvalMhsDetailRepositoryInterface
{
    public function getDetailsByUserId($id_user);
    public function getDetailsByMatkulId($id_matkul);
}
