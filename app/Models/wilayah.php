<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $fillable = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'kodepos'
    ];

    public function dataSiswa()
    {
        return $this->hasMany(PendaftarDataSiswa::class);
    }
}
