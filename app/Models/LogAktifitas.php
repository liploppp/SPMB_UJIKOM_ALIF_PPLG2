<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktifitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktifitas';

    protected $fillable = [
        'user_id',
        'aksi',
        'objek',
        'objek_data',
        'waktu',
        'ip'
    ];

    protected $casts = [
        'objek_data' => 'array',
        'waktu' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'user_id');
    }
}