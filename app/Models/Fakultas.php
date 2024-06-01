<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';

    protected $primaryKey = 'id_fakultas';

    protected $fillable = [
        'nama_fakultas',
        'kode'
    ];
}
