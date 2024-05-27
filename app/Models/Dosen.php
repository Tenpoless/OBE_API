<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dosen';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_dosen'; // Menentukan primary key 'id_dosen'

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_dosen',
        'nip',
        'nama_dosen',
        'tempat_lahir',
        'alamat',
        'no_telpon',
        'email',
        'id_jurusan',
        'id_user'
    ];

    /**
     * Get the user that owns the dosen.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user'); // Relasi one-to-one dengan model User
    }

    /**
     * Get the jurusan that owns the dosen.
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan'); // Relasi many-to-one dengan model Jurusan
    }

    public function pengampu_mk()
    {
        return $this->belongsTo(PengampuMK::class, 'id_dosen', 'id_dosen');
    }
}
