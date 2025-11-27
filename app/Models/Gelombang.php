<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Gelombang extends Model
{
    protected $fillable = [
        'nama',
        'tahun',
        'tgl_mulai',
        'tgl_selesai',
        'biaya_daftar'
    ];

    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date'
    ];

    public static function getGelombangAktif()
    {
        $bulanSekarang = Carbon::now()->month;
        $tahunSekarang = Carbon::now()->year;
        
        if ($bulanSekarang >= 1 && $bulanSekarang <= 6) {
            // Gelombang 1: Januari - Juni
            return (object) [
                'id' => 1,
                'nama' => 'Gelombang 1',
                'tahun' => $tahunSekarang . '-' . ($tahunSekarang + 1),
                'tgl_mulai' => Carbon::create($tahunSekarang, 1, 1),
                'tgl_selesai' => Carbon::create($tahunSekarang, 6, 30),
                'biaya_daftar' => 150000,
                'status' => 'aktif'
            ];
        } else {
            // Gelombang 2: Juli - Desember
            return (object) [
                'id' => 2,
                'nama' => 'Gelombang 2',
                'tahun' => $tahunSekarang . '-' . ($tahunSekarang + 1),
                'tgl_mulai' => Carbon::create($tahunSekarang, 7, 1),
                'tgl_selesai' => Carbon::create($tahunSekarang, 12, 31),
                'biaya_daftar' => 200000,
                'status' => 'aktif'
            ];
        }
    }
    
    public static function getAllGelombang()
    {
        $tahunSekarang = Carbon::now()->year;
        $bulanSekarang = Carbon::now()->month;
        
        $gelombang1 = (object) [
            'id' => 1,
            'nama' => 'Gelombang 1',
            'tahun' => $tahunSekarang . '-' . ($tahunSekarang + 1),
            'tgl_mulai' => Carbon::create($tahunSekarang, 1, 1),
            'tgl_selesai' => Carbon::create($tahunSekarang, 6, 30),
            'biaya_daftar' => 150000,
            'status' => ($bulanSekarang >= 1 && $bulanSekarang <= 6) ? 'aktif' : 'selesai'
        ];
        
        $gelombang2 = (object) [
            'id' => 2,
            'nama' => 'Gelombang 2', 
            'tahun' => $tahunSekarang . '-' . ($tahunSekarang + 1),
            'tgl_mulai' => Carbon::create($tahunSekarang, 7, 1),
            'tgl_selesai' => Carbon::create($tahunSekarang, 12, 31),
            'biaya_daftar' => 200000,
            'status' => ($bulanSekarang >= 7 && $bulanSekarang <= 12) ? 'aktif' : 'belum_mulai'
        ];
        
        return collect([$gelombang1, $gelombang2]);
    }

    public function getSisaHariAttribute()
    {
        if ($this->status === 'aktif') {
            return Carbon::now()->diffInDays($this->tgl_selesai, false);
        }
        return null;
    }
}
