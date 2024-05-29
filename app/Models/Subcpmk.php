<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcpmk extends Model
{
    use HasFactory;

    protected $table = 'subcpmk';
    protected $primaryKey = 'id_subcpmk';

    protected $fillable = [
        'id_subcpmk',
        'kode_subcpmk',
        'subcpmk',
        'kode_baru',
        'id_cplmk',
        'id_matkul',
    ];

    public function evaluasi_mhs()
    {
        return $this->belongsTo(EvaluasiMhs::class, 'id_subcpmk', 'id_subcpmk');
    }
}
