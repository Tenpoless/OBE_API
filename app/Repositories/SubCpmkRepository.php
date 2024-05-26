<?php

namespace App\Repositories;

use App\Models\SubCpmk;
use App\Interfaces\SubCpmkRepositoryInterface;

class SubCpmkRepository implements SubCpmkRepositoryInterface
{
    public function getSubCpmkById($id_subcpmk){
        return SubCpmk::findOrFail($id_subcpmk);
    }
}