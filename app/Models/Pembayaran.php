<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';
    
    protected $fillable = [
        'pendaftar_id',
        'nominal',
        'tanggal_transfer',
        'tanggal_bayar',
        'bukti_pembayaran',
        'catatan',
        'status',
        'tanggal_upload',
        'verified_at',
        'verified_by',
        'alasan_tolak_pembayaran'
    ];

    protected $casts = [
        'tanggal_transfer' => 'date',
        'tanggal_bayar' => 'datetime',
        'tanggal_upload' => 'datetime',
        'verified_at' => 'datetime'
    ];

    // Accessor untuk memastikan status selalu lowercase
    public function getStatusAttribute($value)
    {
        return strtolower($value);
    }

    // Mutator untuk memastikan status disimpan dalam lowercase
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value);
    }

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(Pengguna::class, 'verified_by');
    }
}