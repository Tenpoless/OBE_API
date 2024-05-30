<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Matkul;
use app\Models\DetailRps;

class Evaluasi extends Model
{
    use HasFactory;

    protected $table = 'evaluasi';

    protected $primaryKey = 'id_evaluasi';

    public $timestamps = false;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_detailrps',
        'asesmen',
        'detail_asesmen',
        'id_matkul'
    ];

        // Definisikan relasi ke model DetailRps
        public function detailRps()
        {
            return $this->belongsTo(DetailRps::class, 'id_detailrps', 'id_detailrps');
        }
    
        // Definisikan relasi ke model Matkul
        public function matkul()
        {
            return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
        }
}
