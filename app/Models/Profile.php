<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'username',
        'full_name',
        'role',
        'address',
        'phone_number',
        'city',
        'state',
    ];
}