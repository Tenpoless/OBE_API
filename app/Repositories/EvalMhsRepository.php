<?php

namespace App\Repositories;

use App\Models\Matkul;
use App\Interfaces\EvalMhsRepositoryInterface;

class EvalMhsRepository implements EvalMhsRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function index()
    {
        return Matkul::all();
    }
}
