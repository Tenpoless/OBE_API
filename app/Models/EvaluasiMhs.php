<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiMhs extends Model
{
    use HasFactory;

    protected $table = 'evaluasi_mhs';
    protected $primaryKey = 'id_evaluasi';
    public $timestamps = false;

    protected $fillable = [
        'id_evaluasi',
        'id_matkul',
        'id_mahasiswa',
        'nilai',
        'komentar',
    ];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }
}
