<?php 

namespace App\Interfaces;

interface DetailRpsRepositoryInterface 
{
    public function index();
    public function getDetailRpsById($id_detailrps);
}