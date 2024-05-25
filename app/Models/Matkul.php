<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $table = "matkul";

    protected $primaryKey = "id_matkul";

    protected $fillable = [
        "nama_matkul",
        "kode_matkul",
        "sks_teori",
        "sks_praktek",
        "semester",
        "jenis_mk",
        "id_jurusan",
        "id_tahun"
    ];
}
