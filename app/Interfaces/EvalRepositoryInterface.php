<?php

namespace App\Interfaces;

interface EvalRepositoryInterface
{
    public function index();
    public function getById($id_detailrps);
    public function store(array $data);
    public function update(array $data, $id_evaluasi);
    public function delete($id_evaluasi,$id_matkul,  $id_pengampu);
}
