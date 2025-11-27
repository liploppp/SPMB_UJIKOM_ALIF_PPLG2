<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendaftar_data_siswa extends Model
{
    protected $fillable = [
        'pendaftar_id',
        'nik',
        'nisn',
        'nama',
        'jk',
        'tmp_lahir',
        'tgl_lahir',
        'alamat',
        'wilayah_id'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(pendaftar::class);
    }

    public function wilayah()
    {
        return $this->belongsTo(wilayah::class);
    }
}
