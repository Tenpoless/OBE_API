<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'nip',
        'nama_dosen',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'no_telp',
        'email',
        'gambar',
        'id_jurusan',
        'id_user'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pengampuMk()
    {
        return $this->hasMany(PengampuMk::class, 'id_dosen');
    }
}
