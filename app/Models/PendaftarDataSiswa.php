<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftarDataSiswa extends Model
{
    protected $table = 'pendaftar_data_siswas';
    
    protected $fillable = [
        'pendaftar_id',
        'nik',
        'nisn',
        'nama',
        'jk',
        'tmp_lahir',
        'tgl_lahir',
        'alamat',
        'wilayah_id',
        'lat',
        'lng'
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function getFullAddressAttribute()
    {
        // If coordinates exist but no proper address, convert coordinates to address
        if ($this->lat && $this->lng && (strpos($this->alamat, 'Lat:') !== false || strpos($this->alamat, 'Lng:') !== false)) {
            return $this->convertCoordinatesToAddress();
        }
        
        if ($this->wilayah) {
            return $this->alamat . ', ' . 
                   $this->wilayah->kelurahan . ', ' . 
                   $this->wilayah->kecamatan . ', ' . 
                   $this->wilayah->kabupaten . ', ' . 
                   $this->wilayah->provinsi;
        }
        return $this->alamat;
    }
    
    private function convertCoordinatesToAddress()
    {
        if (!$this->lat || !$this->lng) {
            return $this->alamat;
        }
        
        try {
            // Use Google Geocoding API to convert coordinates to address
            $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$this->lat},{$this->lng}&language=id";
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            
            if ($data['status'] === 'OK' && !empty($data['results'])) {
                return $data['results'][0]['formatted_address'];
            }
        } catch (\Exception $e) {
            // Fallback: try to construct address from wilayah if available
            if ($this->wilayah) {
                return 'Koordinat: ' . $this->lat . ', ' . $this->lng . ' - ' . 
                       $this->wilayah->kelurahan . ', ' . 
                       $this->wilayah->kecamatan . ', ' . 
                       $this->wilayah->kabupaten . ', ' . 
                       $this->wilayah->provinsi;
            }
        }
        
        return "Lat: {$this->lat}, Lng: {$this->lng}";
    }
}