<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal_daftar',
        'no_pendaftaran',
        'gelombang_id',
        'jurusan_id',
        'status',
        'status_berkas',
        'alasan_penolakan',
        'alasan_tolak_berkas'
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'user_id');
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function dataOrtu()
    {
        return $this->hasOne(PendaftarDataOrtu::class);
    }

    public function dataSiswa()
    {
        return $this->hasOne(PendaftarDataSiswa::class);
    }

    public function berkas()
    {
        return $this->hasMany(PendaftarBerkas::class, 'pendaftar_id');
    }

    public function asalSekolah()
    {
        return $this->hasOne(PendaftarAsalSekolah::class);
    }

    public function getFotoAttribute()
    {
        $foto = $this->berkas()->where('jenis', 'FOTO')->first();
        return $foto ? $foto->url : null;
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pendaftar_id');
    }
}