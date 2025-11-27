<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftarDataOrtu extends Model
{
    protected $table = 'pendaftar_data_ortus';
    
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
        return $this->belongsTo(Pendaftar::class);
    }
}