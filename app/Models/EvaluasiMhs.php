<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiMhs extends Model
{
    use HasFactory;

    protected $table = 'evaluasi_mhs';

    protected $primaryKey = 'id_evaluasimhs';

    public $timestamps = false;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_evaluasimhs',
        'id_evaluasi2',
        'nilai_mhs',
        'bobot_mhs',
        'id_matkul',
        'id_user',
    ];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }
}
