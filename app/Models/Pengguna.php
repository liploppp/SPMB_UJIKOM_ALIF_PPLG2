<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $fillable = [
        'nama',
        'email', 
        'hp',
        'password_hash',
        'role',
        'aktif'
    ];

    protected $hidden = [
        'password_hash'
    ];
}
