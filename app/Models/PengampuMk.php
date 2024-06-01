<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengampuMk extends Model
{
    use HasFactory;

    protected $table = 'pengampu_mk';

    protected $primaryKey = 'id_pengampu';

    protected $fillable = [
        'id_dosen',
        'nama_dosen2',
        'nama_dosen3',
        'id_matkul',
        'koordinator',
        'kelas'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'id_matkul', 'id_matkul');
    }
}
