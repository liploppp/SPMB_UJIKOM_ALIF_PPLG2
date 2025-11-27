@extends('layouts.main')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4">SPMB SMK BAKTI NUSANTARA 666</h1>
        <h2 class="text-white mb-4">BANDUNG</h2>
        <p class="text-white mb-0">Tahun Pelajaran 2025-2026</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">PPDB</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- PPDB Form Start -->
<div class="container-fluid program py-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 900px;">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Formulir Pendaftaran</h4>
            <h1 class="mb-5 display-5">SPMB SMK BAKTI NUSANTARA 666</h1>
        </div>
        
        <!-- Cek Status Pendaftaran -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-search me-2"></i>Cek Status Pendaftaran</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">Sudah mendaftar? Cek status pendaftaran dan cetak bukti pendaftaran Anda di sini:</p>
                        <form id="cekStatusForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="cekNisn" placeholder="Masukkan NISN" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="cekNama" placeholder="Masukkan Nama Lengkap" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cek Status</button>
                        </form>
                        
                        <!-- Hasil Pencarian -->
                        <div id="hasilCek" class="mt-4" style="display: none;">
                            <div class="alert alert-info">
                                <h6>Status Pendaftaran:</h6>
                                <div id="statusContent"></div>
                                <div class="mt-3">
                                    <button id="cetakBuktiBtn" class="btn btn-success btn-sm" style="display: none;">
                                        <i class="fas fa-print me-1"></i>Cetak Bukti Pendaftaran
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow border-0 rounded wow fadeIn" data-wow-delay="0.2s">
                    <div class="card-body p-4">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        @if(!Session::has('siswa_id'))
                            <div class="alert alert-warning">
                                <strong>Perhatian!</strong> Anda harus login terlebih dahulu untuk mengisi formulir pendaftaran.
                                <a href="{{ route('auth.login') }}" class="btn btn-primary btn-sm ms-2">Login Sekarang</a>
                            </div>
                        @endif
                        
                        <form id="ppdbForm" method="POST" action="{{ route('ppdb.submit') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Data Pribadi Calon Peserta Didik -->
                            <div class="mb-5">
                                <h3 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Data Pribadi Calon Peserta Didik</h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_panggilan" class="form-label">Nama Panggilan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" placeholder="Masukkan nama panggilan" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nik" name="nik" maxlength="16" placeholder="Nomor Induk Kependudukan (16 digit)" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nisn" name="nisn" maxlength="10" placeholder="Nomor Induk Siswa Nasional (10 digit)" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Contoh: Bandung" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki" required>
                                                <label class="form-check-label" for="laki">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                                                <label class="form-check-label" for="perempuan">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                                        <select class="form-select" id="agama" name="agama" required>
                                            <option value="">Pilih agama</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="no_hp_siswa" class="form-label">No. HP / WA <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="no_hp_siswa" name="no_hp_siswa" placeholder="Masukkan nomor telepon aktif" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="alamat_rumah" class="form-label">Alamat Rumah (Lengkap) <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat_rumah" name="alamat_rumah" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="openMapModal()" id="mapButton">
                                        <i class="fas fa-map-marker-alt me-1"></i>Pilih Lokasi di Peta
                                    </button>
                                    <div id="mapStatus" class="mt-1" style="display: none;">
                                        <small class="text-warning">Sedang memuat peta...</small>
                                    </div>
                                    <small class="form-text text-muted d-block mt-1">Opsional: Gunakan peta untuk memilih lokasi yang akurat</small>
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input type="hidden" id="longitude" name="longitude">
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="provinsi" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Nama provinsi" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="kabupaten" class="form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Nama kabupaten/kota" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Nama kecamatan" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="desa" class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="desa" name="desa" placeholder="Nama desa/kelurahan" required>
                                    </div>
                                </div>
                                

                            </div>
                            
                            <!-- Data Pendidikan Sebelumnya -->
                            <div class="mb-5">
                                <h3 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Data Pendidikan Sebelumnya</h3>
                                
                                <div class="mb-3">
                                    <label for="asal_sekolah" class="form-label">Asal Sekolah <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="Contoh: SMP BAKTI NUSANTARA 666" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="alamat_sekolah" class="form-label">Alamat Lengkap Sekolah <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" rows="3" placeholder="Masukkan alamat sekolah" required></textarea>
                                </div>
                            </div>
                            
                            <!-- Data Orang Tua (Ayah) -->
                            <div class="mb-5">
                                <h3 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Data Orang Tua (Ayah)</h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_ayah" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama ayah" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pekerjaan_ayah" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan ayah" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="no_hp_ayah" class="form-label">No. HP/WA <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="no_hp_ayah" name="no_hp_ayah" placeholder="Nomor telepon ayah" required>
                                </div>
                            </div>
                            
                            <!-- Data Orang Tua (Ibu) -->
                            <div class="mb-5">
                                <h3 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Data Orang Tua (Ibu)</h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_ibu" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama ibu" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pekerjaan_ibu" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan ibu" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="no_hp_ibu" class="form-label">No. HP/WA <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="no_hp_ibu" name="no_hp_ibu" placeholder="Nomor telepon ibu" required>
                                </div>
                            </div>
                            

                            
                            <!-- Pilihan Jurusan dan Gelombang -->
                            <div class="mb-5">
                                <h3 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Pilihan Jurusan dan Gelombang</h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pilihan_jurusan" class="form-label">Pilihan Jurusan <span class="text-danger">*</span></label>
                                        <select class="form-select" id="pilihan_jurusan" name="pilihan_jurusan" required>
                                            <option value="">Pilih Jurusan</option>
                                            @foreach($jurusans as $jurusan)
                                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gelombang" class="form-label">Gelombang Pendaftaran</label>
                                        <input type="hidden" name="gelombang" value="{{ $gelombangAktif->id }}">
                                        <div class="form-control-plaintext border rounded p-3 bg-light">
                                            <strong>{{ $gelombangAktif->nama }} ({{ $gelombangAktif->tahun }})</strong><br>
                                            <small class="text-muted">
                                                {{ $gelombangAktif->tgl_mulai->format('M Y') }} s/d {{ $gelombangAktif->tgl_selesai->format('M Y') }}
                                            </small><br>
                                            <span class="text-primary fw-bold">Rp {{ number_format($gelombangAktif->biaya_daftar, 0, ',', '.') }}</span>
                                            <span class="badge bg-success ms-2">Sedang Berlangsung</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Upload Berkas -->
                            <div class="mb-5">
                                <h3 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Upload Berkas</h3>
                                <p class="text-muted mb-3">Format: PDF/JPG, maksimal 2MB per file</p>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="berkas_ijazah" class="form-label">Ijazah/SKHUN <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="berkas_ijazah" name="berkas_ijazah" accept=".pdf,.jpg,.jpeg" required>
                                        <div class="form-text">Upload scan ijazah/SKHUN (PDF/JPG)</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="berkas_rapor" class="form-label">Rapor <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="berkas_rapor" name="berkas_rapor" accept=".pdf,.jpg,.jpeg" required>
                                        <div class="form-text">Upload scan rapor terakhir (PDF/JPG)</div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="berkas_kk" class="form-label">Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="berkas_kk" name="berkas_kk" accept=".pdf,.jpg,.jpeg" required>
                                        <div class="form-text">Upload scan Kartu Keluarga (PDF/JPG)</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="berkas_akta" class="form-label">Akta Kelahiran <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="berkas_akta" name="berkas_akta" accept=".pdf,.jpg,.jpeg" required>
                                        <div class="form-text">Upload scan Akta Kelahiran (PDF/JPG)</div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="berkas_foto" class="form-label">Pas Foto <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="berkas_foto" name="berkas_foto" accept=".jpg,.jpeg" required>
                                        <div class="form-text">Upload pas foto 3x4 (JPG)</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="berkas_kip" class="form-label">KIP/KKS (Jika Ada)</label>
                                        <input type="file" class="form-control" id="berkas_kip" name="berkas_kip" accept=".pdf,.jpg,.jpeg">
                                        <div class="form-text">Upload scan KIP/KKS (PDF/JPG)</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Pernyataan Calon Peserta Didik -->
                            <div class="mb-5">
                                <h3 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Pernyataan Calon Peserta Didik</h3>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="pernyataan" name="pernyataan" required>
                                        <label class="form-check-label" for="pernyataan">
                                            Saya menyatakan bahwa data yang saya isi dalam formulir ini adalah benar dan sah. 
                                            Saya bersedia menerima segala konsekuensi jika data yang saya berikan ternyata tidak benar.
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="persetujuan" name="persetujuan" required>
                                        <label class="form-check-label" for="persetujuan">
                                            Saya menyetujui semua syarat dan ketentuan yang berlaku dalam proses PPDB SMK BAKTI NUSANTARA 666.
                                        </label>
                                    </div>
                                </div>
                                
                                <p class="mt-3"><strong>Dengan mengirim formulir ini, saya menyetujui semua ketentuan yang berlaku.</strong></p>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5 py-3 text-white btn-border-radius">Kirim Pendaftaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PPDB Form End -->

<!-- Custom CSS for Form -->
<style>
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
    }
    
    .form-check-input {
        margin-top: 0.25rem;
    }
    
    .card {
        border: none;
    }
    
    .title-border-radius {
        border-radius: 0.5rem;
    }
    
    .btn-border-radius {
        border-radius: 0.5rem;
    }
    
    h3 {
        font-size: 1.5rem;
    }
    
    .is-invalid {
        border-color: #dc3545;
    }
    
    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }
    
    .is-invalid ~ .invalid-feedback {
        display: block;
    }
    
    #map {
        height: 400px;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 0.5rem;
    }
    
    .modal-body #map {
        min-height: 400px;
    }
    
    /* Memastikan Google Maps terlihat */
    .gm-style {
        font-family: inherit;
    }
    
    /* Loading state untuk peta */
    #map.loading {
        background: #f8f9fa url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBzdHJva2U9IiMwMDciPjxnIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMSAxKSIgc3Ryb2tlLXdpZHRoPSIyIj48Y2lyY2xlIHN0cm9rZS1vcGFjaXR5PSIuNSIgY3g9IjE4IiBjeT0iMTgiIHI9IjE4Ii8+PHBhdGggZD0ibTM5IDM5YzAtMTEuMDQ2LTguOTU0LTIwLTIwLTIwUzE5IDI3Ljk1NCAxOSAzOSIgc3Ryb2tlLW9wYWNpdHk9IjEiPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0icm90YXRlIiBmcm9tPSIwIDM5IDM5IiB0bz0iMzYwIDM5IDM5IiBkdXI9IjFzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSIvPjwvcGF0aD48L2c+PC9nPjwvc3ZnPg==') center center no-repeat;
        background-size: 40px 40px;
    }
</style>

<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Lokasi Alamat Rumah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="searchLocation" class="form-control" placeholder="Ketik alamat lengkap (contoh: Jl. Merdeka No. 1, Bandung)">
                    <button type="button" class="btn btn-primary btn-sm mt-2" onclick="searchAddress()">Cari</button>
                    <small class="form-text text-muted d-block mt-1">Gunakan alamat lengkap untuk hasil yang lebih akurat</small>
                </div>
                <div id="map" class="loading"></div>
                <div class="mt-3">
                    <p><strong>Alamat Terpilih:</strong></p>
                    <p id="selectedAddress">Belum ada lokasi yang dipilih</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="confirmLocation()">Gunakan Lokasi Ini</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Form Validation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('ppdbForm');
        // File size validation function
        function validateFileSize(fileInput, maxSizeMB) {
            if (fileInput.files.length > 0) {
                const fileSize = fileInput.files[0].size / 1024 / 1024; // in MB
                if (fileSize > maxSizeMB) {
                    fileInput.classList.add('is-invalid');
                    return false;
                } else {
                    fileInput.classList.remove('is-invalid');
                    return true;
                }
            }
            return true;
        }
        
        // File type validation function
        function validateFileType(fileInput, allowedTypes) {
            if (fileInput.files.length > 0) {
                const fileName = fileInput.files[0].name;
                const fileExtension = fileName.split('.').pop().toLowerCase();
                if (!allowedTypes.includes(fileExtension)) {
                    fileInput.classList.add('is-invalid');
                    return false;
                } else {
                    fileInput.classList.remove('is-invalid');
                    return true;
                }
            }
            return true;
        }
        
        // Add file validation event listeners
        const fileInputs = form.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                // Validate file type
                const allowedTypes = this.accept.replace('.', '').split(',');
                validateFileType(this, allowedTypes);
                
                // Validate file size (2MB limit)
                validateFileSize(this, 2);
            });
        });
        

        // Form submission
        form.addEventListener('submit', function(e) {
            // Check if user is logged in
            @if(!Session::has('siswa_id'))
                e.preventDefault();
                alert('Silakan login terlebih dahulu untuk mengisi formulir pendaftaran!');
                return;
            @endif
            
            // Basic validation
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (field.type === 'checkbox') {
                    if (!field.checked) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                } else if (field.type === 'file') {
                    // File validation is optional for now
                    field.classList.remove('is-invalid');
                } else {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });
        
        // Remove invalid class when user starts typing
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value) {
                    this.classList.remove('is-invalid');
                }
            });
            
            // For checkboxes
            if (input.type === 'checkbox') {
                input.addEventListener('change', function() {
                    if (this.checked) {
                        this.classList.remove('is-invalid');
                    }
                });
            }
        });
        

        
        // Cek Status Pendaftaran
        const cekStatusForm = document.getElementById('cekStatusForm');
        const hasilCek = document.getElementById('hasilCek');
        const statusContent = document.getElementById('statusContent');
        const cetakBuktiBtn = document.getElementById('cetakBuktiBtn');
        
        cekStatusForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nisn = document.getElementById('cekNisn').value;
            const nama = document.getElementById('cekNama').value;
            
            if (!nisn || !nama) {
                alert('Harap isi NISN dan Nama Lengkap');
                return;
            }
            
            // Redirect ke halaman cek status dengan parameter
            window.location.href = `/cek-status?nisn=${encodeURIComponent(nisn)}&nama=${encodeURIComponent(nama)}`;
        });
    });
    
    // Leaflet map functionality
    let map, marker, selectedLat, selectedLng, selectedAddress;
    
    function openMapModal() {
        const mapModal = new bootstrap.Modal(document.getElementById('mapModal'));
        mapModal.show();
        
        setTimeout(() => {
            if (!map) {
                initializeMap();
            }
        }, 500);
    }
    
    function initializeMap() {
        const mapElement = document.getElementById('map');
        mapElement.classList.remove('loading');
        
        // Default to Bandung, Indonesia
        const defaultLat = -6.9175;
        const defaultLng = 107.6191;
        
        // Initialize Leaflet map
        map = L.map('map').setView([defaultLat, defaultLng], 13);
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        
        // Add draggable marker
        marker = L.marker([defaultLat, defaultLng], {
            draggable: true,
            title: 'Drag untuk memindahkan lokasi'
        }).addTo(map);
        
        // Initialize with default location
        updateLocation(defaultLat, defaultLng);
        
        // Map click event
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            marker.setLatLng([lat, lng]);
            updateLocation(lat, lng);
        });
        
        // Marker drag event
        marker.on('dragend', function(e) {
            const lat = e.target.getLatLng().lat;
            const lng = e.target.getLatLng().lng;
            updateLocation(lat, lng);
        });
        
        // Try to get user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    map.setView([userLat, userLng], 15);
                    marker.setLatLng([userLat, userLng]);
                    updateLocation(userLat, userLng);
                },
                (error) => {
                    console.log('Geolocation error:', error);
                    // Keep default location if geolocation fails
                }
            );
        }
    }
    
    async function updateLocation(lat, lng) {
        selectedLat = lat;
        selectedLng = lng;
        
        try {
            // Call zoom 18 untuk detail
            const res1 = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1&zoom=18`);
            const data1 = await res1.json();
            
            // Call zoom 13 untuk kecamatan
            const res2 = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1&zoom=13`);
            const data2 = await res2.json();
            
            if (data1 && data1.display_name) {
                selectedAddress = data1.display_name;
                document.getElementById('selectedAddress').textContent = selectedAddress;
                
                const addr1 = data1.address || {};
                const addr2 = data2.address || {};
                
                console.log('Zoom 18:', addr1);
                console.log('Zoom 13:', addr2);
                
                // Alamat rumah
                let alamat = '';
                if (addr1.road) alamat = addr1.road;
                if (addr1.house_number) alamat += ' No. ' + addr1.house_number;
                document.getElementById('alamat_rumah').value = alamat || data1.display_name;
                
                // Provinsi
                if (addr1.state) {
                    document.getElementById('provinsi').value = addr1.state;
                }
                
                // Kabupaten/Kota
                let kabupaten = addr1.county || addr1.city || addr1.town || addr2.county || addr2.city || '';
                kabupaten = kabupaten.replace(/^(Kabupaten|Kota)\s+/i, '');
                if (kabupaten) {
                    document.getElementById('kabupaten').value = kabupaten;
                }
                
                // Kecamatan - prioritas dari zoom 13, fallback parsing
                let kecamatan = addr2.suburb || addr2.city_district || addr2.municipality || 
                               addr1.suburb || addr1.city_district || '';
                
                // Jika masih kosong, parse dari display_name
                if (!kecamatan) {
                    const parts = data1.display_name.split(',').map(s => s.trim());
                    console.log('Parsing parts:', parts);
                    
                    // Format Indonesia: Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi, ...
                    // Kecamatan biasanya di index 1 (setelah kelurahan)
                    if (parts.length >= 3) {
                        // Ambil index 1 sebagai kecamatan
                        kecamatan = parts[1];
                    }
                }
                
                kecamatan = kecamatan.replace(/^Kecamatan\s+/i, '');
                if (kecamatan) {
                    document.getElementById('kecamatan').value = kecamatan;
                }
                
                console.log('Display parts:', data1.display_name.split(','));
                
                // Kelurahan/Desa
                let kelurahan = addr1.village || addr1.neighbourhood || addr1.hamlet || addr1.quarter || '';
                kelurahan = kelurahan.replace(/^(Desa|Kelurahan)\s+/i, '');
                if (kelurahan) {
                    document.getElementById('desa').value = kelurahan;
                }
                
                console.log('Filled:', {kabupaten, kecamatan, kelurahan});
            } else {
                selectedAddress = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
                document.getElementById('selectedAddress').textContent = selectedAddress;
                document.getElementById('alamat_rumah').value = selectedAddress;
            }
        } catch (error) {
            console.log('Error:', error);
            selectedAddress = `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
            document.getElementById('selectedAddress').textContent = selectedAddress;
            document.getElementById('alamat_rumah').value = selectedAddress;
        }
    }
    
    function searchAddress() {
        const address = document.getElementById('searchLocation').value.trim();
        if (!address) {
            alert('Masukkan alamat yang ingin dicari');
            return;
        }
        
        // Use Nominatim for address search
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&countrycodes=id&limit=1`;
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const result = data[0];
                    const lat = parseFloat(result.lat);
                    const lng = parseFloat(result.lon);
                    
                    map.setView([lat, lng], 15);
                    marker.setLatLng([lat, lng]);
                    updateLocation(lat, lng);
                } else {
                    alert('Alamat tidak ditemukan. Coba gunakan alamat yang lebih spesifik.');
                }
            })
            .catch(error => {
                console.log('Search error:', error);
                alert('Terjadi kesalahan saat mencari alamat.');
            });
    }
    
    function confirmLocation() {
        if (!selectedLat || !selectedLng) {
            alert('Silakan pilih lokasi terlebih dahulu');
            return;
        }
        
        // Simpan koordinat ke hidden input
        document.getElementById('latitude').value = selectedLat;
        document.getElementById('longitude').value = selectedLng;
        
        // Tutup modal
        bootstrap.Modal.getInstance(document.getElementById('mapModal')).hide();
        
        // Update status button
        document.getElementById('mapButton').innerHTML = '<i class="fas fa-check-circle me-1"></i>Lokasi Dipilih';
        document.getElementById('mapButton').classList.remove('btn-outline-primary');
        document.getElementById('mapButton').classList.add('btn-success');
        
        alert('Lokasi dan alamat berhasil dipilih!');
    }
    

    
    window.openMapModal = openMapModal;
    window.searchAddress = searchAddress;
    window.confirmLocation = confirmLocation;
</script>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@endsection