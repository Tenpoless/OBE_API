<?php

namespace App\Repositories;

use App\Models\HalamanUtama;
use App\Interfaces\HalUtamaRepositoryInterface;

class HalUtamaRepository implements HalUtamaRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function getAll()
    {
        return HalamanUtama::all();
    }

    public function getById($id)
    {
        return HalamanUtama::findOrFail($id);
    }
}
