<?php

namespace App\Http\Controllers;

use App\Interfaces\SubCpmkRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\SubCpmkResource;
use Illuminate\Http\Request;

class SubCpmkController extends Controller
{
    private SubCpmkRepositoryInterface $subCpmkRepositoryInterface;

    public function __construct(SubCpmkRepositoryInterface $subCpmkRepositoryInterface)
    {
        $this->subCpmkRepositoryInterface = $subCpmkRepositoryInterface;
    }

    public function show($id_subcpmk)
    {
        $subcpmk = $this->subCpmkRepositoryInterface->getSubCpmkById($id_subcpmk);

        return ApiResponseClass::sendResponse(new SubCpmkResource($subcpmk),'',200);
    }
}
