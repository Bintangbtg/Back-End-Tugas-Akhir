<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kompetisi extends Model
{
    use HasFactory;

    protected $table = 'kompetisi';

    protected $fillable = [
        'nama_kompetisi',
        'deskripsi',
        'kategori',
        'biaya_pendaftaran',
        'foto_poster',
    ];
}
