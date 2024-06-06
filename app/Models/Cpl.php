<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpl extends Model
{
    use HasFactory;

    protected $table = 'cpl';
    protected $primaryKey = 'id_cpl';

    protected $fillable = [
        'id_cpl',
        'id_aspek',
        'cpl',
        'sumber',
        'id_jurusan',
        'kode_cpl',
        'total_cpl',
    ];

    public function evaluasi_mhs()
    {
        return $this->belongsTo(EvaluasiMhs::class, 'id_cpl', 'id_cpl');
    }

    public function subcpmk()
    {
        return $this->hasMany(Subcpmk::class, 'id_cplmk', 'id_cpl');
    }
}
