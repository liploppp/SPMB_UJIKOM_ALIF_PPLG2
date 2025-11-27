<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftarBerkas extends Model
{
    protected $table = 'pendaftar_berkas';
    
    protected $fillable = [
        'pendaftar_id',
        'jenis',
        'nama_file',
        'url',
        'ukuran_kb',
        'valid',
        'catatan'
    ];
    
    protected $casts = [
        'valid' => 'boolean',
        'ukuran_kb' => 'integer'
    ];
    
    // Jenis berkas yang diizinkan
    public static $jenisAllowed = [
        'FOTO', 'IJAZAH', 'RAPOR', 'KIP', 'KKS', 'AKTA', 'KK', 'LAINNYA'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id');
    }
    
    public function getFileUrlAttribute()
    {
        return url('berkas.php?file=' . $this->nama_file);
    }
    
    public function getIsImageAttribute()
    {
        $extension = strtolower(pathinfo($this->nama_file, PATHINFO_EXTENSION));
        return in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }
}
