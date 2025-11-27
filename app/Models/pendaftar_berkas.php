<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendaftar_berkas extends Model
{
    protected $fillable = [
        'pendaftar_id',
        'jenis',
        'nama_file',
        'url',
        'ukuran_kb',
        'valid',
        'catatan'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(pendaftar::class);
    }
}
