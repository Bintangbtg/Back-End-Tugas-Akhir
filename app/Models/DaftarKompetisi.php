<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarKompetisi extends Model
{
    protected $table = 'daftar_kompetisi';

    protected $fillable = [
        'id_kompetisi',
        'nama',
        'email',
        'phone_number',
    ];

}