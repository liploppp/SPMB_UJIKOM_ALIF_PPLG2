<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pendaftar_data_ortu extends Model
{
    protected $fillable = [
        'pendaftar_id',
        'nama_ayah',
        'pekerjaan_ayah',
        'hp_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'hp_ibu'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(pendaftar::class);
    }
}
