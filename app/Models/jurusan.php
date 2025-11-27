<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'kuota'
    ];

    public function pendaftars()
    {
        return $this->hasMany(Pendaftar::class);
    }


}
