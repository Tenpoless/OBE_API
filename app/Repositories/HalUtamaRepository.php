<?php

namespace App\Repositories;

use App\Interfaces\HalUtamaRepositoryInterface;
use App\Models\User;

class HalUtamaRepository implements HalUtamaRepositoryInterface
{
    public function getNamaDosen($id)
    {
        return User::findOrFail($id);
    }

    public function getProfileDosen($id)
    {
        return User::with('dosen.jurusan')->findOrFail($id);
    }
}
