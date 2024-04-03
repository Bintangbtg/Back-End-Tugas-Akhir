<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['name', 'biaya_pendaftaran', 'status']; // tambahkan 'name' di sini
}