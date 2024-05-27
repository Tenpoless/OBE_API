<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRPS extends Model
{
    use HasFactory;

    protected $table = 'detail_rps';

    protected $primaryKey = 'id_detailrps';

    public $timestamps = false;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_detailrps',
        'minggu',
        'id_subcpmk',
        'indikator',
        'kriteria',
        'luring',
        'daring',
        'matteri',
        'bobot',
        'id_matkul'
    ];

    public function matkul()
    {
        return $this->belongsTo(DetailRPS::class, 'id_matkul', 'id_matkul');
    }
}
