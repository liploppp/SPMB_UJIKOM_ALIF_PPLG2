@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.profile-header {
    background: var(--gradient-primary);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 30px rgba(233, 30, 99, 0.2);
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid white;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.profile-avatar-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    border: 5px solid white;
}

.profile-info h1 {
    color: #1e293b;
    font-size: 2rem;
    font-weight: 700;
    margin: 0 0 8px 0;
    background: rgba(255,255,255,0.9);
    padding: 8px 16px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.profile-info p {
    color: #1e293b;
    font-size: 1.1rem;
    margin: 0;
    background: rgba(255,255,255,0.85);
    padding: 6px 12px;
    border-radius: 6px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
}

.data-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(233, 30, 99, 0.1);
    border: 2px solid var(--primary-light);
    overflow: hidden;
    margin-bottom: 20px;
}

.data-card-header {
    background: var(--gradient-secondary);
    padding: 20px;
    border-bottom: 2px solid var(--primary-light);
}

.data-card-header h3 {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.2rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.data-card-body {
    padding: 20px;
}

.data-field {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 12px 0;
    border-bottom: 1px solid rgba(233, 30, 99, 0.1);
}

.data-field:last-child {
    border-bottom: none;
}

.data-label {
    font-weight: 600;
    color: #666;
    min-width: 140px;
    font-size: 0.9rem;
}

.data-value {
    color: #333;
    font-weight: 500;
    flex: 1;
    text-align: right;
}

.data-value.empty {
    color: #999;
    font-style: italic;
}

.status-update-section {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(233, 30, 99, 0.1);
    border: 2px solid var(--primary-light);
    overflow: hidden;
}

.status-update-header {
    background: var(--gradient-secondary);
    padding: 20px;
    border-bottom: 2px solid var(--primary-light);
}

.status-update-header h3 {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.2rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.status-update-body {
    padding: 20px;
}

.status-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-status {
    padding: 12px 24px;
    border: none;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-verifikasi {
    background: linear-gradient(135deg, #2196f3, #1976d2);
    color: white;
}

.btn-terima {
    background: linear-gradient(135deg, #4caf50, #2e7d32);
    color: white;
}

.btn-tolak {
    background: linear-gradient(135deg, #f44336, #d32f2f);
    color: white;
}

.btn-status:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}



.berkas-item {
    background: white;
    border: 2px solid var(--primary-light);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.berkas-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(233, 30, 99, 0.15);
    border-color: var(--primary-color);
}
.berkas-image {
    transition: transform 0.2s ease, opacity 0.3s ease;
    position: relative;
    opacity: 0.8;
}
.berkas-image:hover {
    transform: scale(1.02);
    opacity: 1;
}
.berkas-image.loading {
    opacity: 0.5;
}
.spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #007bff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.error-message {
    background-color: #fee;
    color: #c53030;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    margin-top: 4px;
}
.file-preview {
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    position: relative;
}
.loading-spinner {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 10;
}
.berkas-item {
    transition: all 0.2s ease;
}
.berkas-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: translateY(-1px);
}
</style>

<script>
// Functions will be loaded from external JS file
</script>
<script src="{{ asset('js/admin-berkas.js') }}"></script>
<script src="{{ asset('js/admin-delete.js') }}"></script>
@endpush

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h6 class="mb-0">Detail Pendaftar</h6>
                        <p class="mb-0 text-sm leading-normal text-slate-400">{{ $pendaftar->no_pendaftaran }}</p>
                    </div>
                    <a href="{{ route('admin.pendaftar.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-full shadow-md hover:shadow-lg transition-all duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="flex-auto p-6">
                @if(session('success'))
                    <div class="mb-4 p-4 text-green-700 bg-green-100 border border-green-300 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="mb-4 p-4 text-red-700 bg-red-100 border border-red-300 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                
                <!-- Profile Card -->
                <div class="dashboard-card">
                    <div class="flex-auto p-4">
                        <div class="flex items-center justify-between">
                            <!-- Left: Avatar + Info -->
                            <div class="flex items-center">
                                <div class="relative">
                                    @php
                                        $foto = $pendaftar->berkas->where('jenis', 'FOTO')->first();
                                    @endphp
                                    @if($foto)
                                        <img src="{{ url('berkas.php?file=' . $foto->nama_file) }}" 
                                             alt="Foto {{ $pendaftar->dataSiswa->nama ?? 'Pendaftar' }}" 
                                             class="w-16 h-16 rounded-xl object-cover border-2 border-white shadow-lg" 
                                             onerror="this.src='{{ asset('img/no-image.jpg') }}';"> 
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-gradient-to-tl from-green-600 to-lime-400 rounded-full border-2 border-white flex items-center justify-center shadow-md">
                                            <i class="fas fa-check text-white text-xs"></i>
                                        </div>
                                    @else
                                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-slate-200 to-slate-300 border-2 border-white flex items-center justify-center shadow-lg">
                                            <i class="fas fa-user text-slate-500 text-lg"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="ml-20">
                                    <h3 class="mb-0 font-bold text-lg">{{ $pendaftar->dataSiswa->nama ?? 'Nama tidak tersedia' }}</h3>
                                    <div class="flex items-center gap-4 mt-2">
                                        <div class="flex items-center gap-2">
                                            <div class="stats-icon-bg blue" style="width: 1.5rem; height: 1.5rem; font-size: 0.6rem;">
                                                <i class="fas fa-id-card text-white"></i>
                                            </div>
                                            <span class="font-sans font-semibold leading-normal text-sm">{{ $pendaftar->no_pendaftaran }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="stats-icon-bg purple" style="width: 1.5rem; height: 1.5rem; font-size: 0.6rem;">
                                                <i class="fas fa-graduation-cap text-white"></i>
                                            </div>
                                            <span class="font-sans font-semibold leading-normal text-sm">{{ $pendaftar->jurusan->nama ?? 'Belum memilih jurusan' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right: Status -->
                            <div class="text-right">
                                <div class="mb-2">
                                    <small class="text-slate-600">Status Berkas:</small><br>
                                    @if($pendaftar->status_berkas == 'DITERIMA')
                                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            <i class="fas fa-check mr-1"></i>Diterima
                                        </span>
                                    @elseif($pendaftar->status_berkas == 'DITOLAK')
                                        <span class="bg-gradient-to-tl from-red-600 to-rose-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                        </span>
                                    @else
                                        <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            <i class="fas fa-hourglass-half mr-1"></i>Menunggu
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                
                <div class="flex flex-wrap -mx-3">
                    <!-- Data Siswa -->
                    <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h3><i class="fas fa-user-graduate"></i> Data Siswa</h3>
                            </div>
                            <div class="data-card-body">
                                <div class="data-field">
                                    <span class="data-label">NIK</span>
                                    <span class="data-value {{ empty($pendaftar->dataSiswa->nik) ? 'empty' : '' }}">{{ $pendaftar->dataSiswa->nik ?? 'Tidak tersedia' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">NISN</span>
                                    <span class="data-value {{ empty($pendaftar->dataSiswa->nisn) ? 'empty' : '' }}">{{ $pendaftar->dataSiswa->nisn ?? 'Tidak tersedia' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Nama Lengkap</span>
                                    <span class="data-value {{ empty($pendaftar->dataSiswa->nama) ? 'empty' : '' }}">{{ $pendaftar->dataSiswa->nama ?? 'Tidak tersedia' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Jenis Kelamin</span>
                                    <span class="data-value">{{ $pendaftar->dataSiswa->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Tempat, Tanggal Lahir</span>
                                    <span class="data-value">{{ $pendaftar->dataSiswa->tmp_lahir ?? 'Tidak tersedia' }}, {{ $pendaftar->dataSiswa->tgl_lahir ? \Carbon\Carbon::parse($pendaftar->dataSiswa->tgl_lahir)->format('d/m/Y') : 'Tidak tersedia' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Alamat Lengkap</span>
                                    <span class="data-value {{ empty($pendaftar->dataSiswa->full_address) ? 'empty' : '' }}" id="alamat-display-{{ $pendaftar->id }}" 
                                          data-lat="{{ $pendaftar->dataSiswa->lat }}" 
                                          data-lng="{{ $pendaftar->dataSiswa->lng }}">
                                        {{ $pendaftar->dataSiswa->full_address ?? 'Tidak tersedia' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Orang Tua -->
                    <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h3><i class="fas fa-users"></i> Data Orang Tua</h3>
                            </div>
                            <div class="data-card-body">
                                <div class="data-field">
                                    <span class="data-label">Nama Ayah</span>
                                    <span class="data-value {{ empty($pendaftar->dataOrtu->nama_ayah) ? 'empty' : '' }}">{{ $pendaftar->dataOrtu->nama_ayah ?? 'Tidak tersedia' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Pekerjaan Ayah</span>
                                    <span class="data-value {{ empty($pendaftar->dataOrtu->pekerjaan_ayah) ? 'empty' : '' }}">{{ $pendaftar->dataOrtu->pekerjaan_ayah ?? 'Tidak tersedia' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">HP Ayah</span>
                                    <span class="data-value {{ empty($pendaftar->dataOrtu->hp_ayah) ? 'empty' : '' }}">{{ $pendaftar->dataOrtu->hp_ayah ?? 'Tidak tersedia' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Nama Ibu</span>
                                    <span class="data-value {{ empty($pendaftar->dataOrtu->nama_ibu) ? 'empty' : '' }}">{{ $pendaftar->dataOrtu->nama_ibu ?? 'Tidak tersedia' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Pekerjaan Ibu</span>
                                    <span class="data-value {{ empty($pendaftar->dataOrtu->pekerjaan_ibu) ? 'empty' : '' }}">{{ $pendaftar->dataOrtu->pekerjaan_ibu ?? 'Tidak tersedia' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">HP Ibu</span>
                                    <span class="data-value {{ empty($pendaftar->dataOrtu->hp_ibu) ? 'empty' : '' }}">{{ $pendaftar->dataOrtu->hp_ibu ?? 'Tidak tersedia' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-wrap -mx-3 mt-4">
                    <!-- Data Pendaftaran -->
                    <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h3><i class="fas fa-clipboard-list"></i> Data Pendaftaran PPDB</h3>
                            </div>
                            <div class="data-card-body">
                                <div class="data-field">
                                    <span class="data-label">Nomor Pendaftaran</span>
                                    <span class="data-value font-mono font-bold text-slate-700 bg-slate-100 px-2 py-1 rounded">{{ $pendaftar->no_pendaftaran }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Tanggal Mendaftar</span>
                                    <span class="data-value text-slate-600">{{ \Carbon\Carbon::parse($pendaftar->tanggal_daftar)->format('d F Y, H:i') }} WIB</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Gelombang PPDB</span>
                                    <span class="data-value text-slate-600">{{ $pendaftar->gelombang->nama ?? 'Belum ditentukan' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Jurusan yang Dipilih</span>
                                    <span class="data-value font-semibold text-slate-700 bg-indigo-50 px-2 py-1 rounded border border-indigo-200">{{ $pendaftar->jurusan->nama ?? 'Belum memilih jurusan' }}</span>
                                </div>
                                <div class="data-field">
                                    <span class="data-label">Status Verifikasi</span>
                                    <span class="data-value">
                                        <span class="inline-flex items-center px-3 py-1 font-medium text-sm rounded-full {{ $pendaftar->status == 'SUBMIT' ? 'bg-amber-100 text-amber-800 border border-amber-200' : ($pendaftar->status == 'DITERIMA' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : ($pendaftar->status == 'DITOLAK' ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-blue-100 text-blue-800 border border-blue-200')) }}">
                                            <i class="fas fa-{{ $pendaftar->status == 'DITERIMA' ? 'check-circle' : ($pendaftar->status == 'DITOLAK' ? 'times-circle' : ($pendaftar->status == 'VERIFIKASI' ? 'clock' : 'hourglass-half')) }} mr-2"></i>
                                            {{ $pendaftar->status == 'SUBMIT' ? 'Menunggu Verifikasi' : ($pendaftar->status == 'DITERIMA' ? 'Diterima' : ($pendaftar->status == 'DITOLAK' ? 'Ditolak' : 'Dalam Verifikasi')) }}
                                        </span>
                                    </span>
                                </div>
                                @if($pendaftar->status == 'DITOLAK' && $pendaftar->alasan_penolakan)
                                <div class="data-field flex-col items-start">
                                    <span class="data-label mb-2">Alasan Penolakan</span>
                                    <div class="w-full bg-red-50 border border-red-200 rounded-lg p-3">
                                        <p class="text-red-800 text-sm mb-0">{{ $pendaftar->alasan_penolakan }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Berkas -->
                    <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                                <h6 class="mb-0">Berkas Upload</h6>
                            </div>
                            <div class="flex-auto p-4">
                                @if($pendaftar->berkas->count() > 0)
                                    @foreach($pendaftar->berkas as $berkas)
                                    <div class="mb-3 p-3 border border-gray-200 rounded-lg berkas-item" data-file="{{ $berkas->nama_file }}">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <p class="mb-1 text-xs font-semibold leading-tight text-blue-600">{{ $berkas->jenis }}</p>
                                                <p class="mb-1 text-xs text-slate-600">{{ $berkas->nama_file }}</p>
                                                <p class="text-xs text-slate-400">({{ number_format($berkas->ukuran_kb) }} KB)</p>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                @if($berkas->valid)
                                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded">Valid</span>
                                                @else
                                                    <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-600 rounded">Pending</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        @php
                                            $extension = strtolower(pathinfo($berkas->nama_file, PATHINFO_EXTENSION));
                                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                            $fileUrl = url('berkas.php?file=' . urlencode($berkas->nama_file));
                                        @endphp
                                        
                                        @if(in_array($extension, $imageExtensions))
                                            <div class="mb-3 file-preview">
                                                <div class="loading-spinner" style="display: none;">
                                                    <div class="spinner"></div>
                                                    <p class="text-xs text-gray-500 mt-2">Memuat gambar...</p>
                                                </div>
                                                <img src="{{ $fileUrl }}" 
                                                     alt="{{ $berkas->jenis }}" 
                                                     class="berkas-image w-full h-auto rounded-lg" 
                                                     style="max-height: 300px; object-fit: contain; background: #f8f9fa; border: 1px solid #ddd;" 
                                                     onload="this.parentElement.querySelector('.loading-spinner').style.display='none'; this.style.display='block';"
                                                     onerror="handleImageError(this, '{{ $berkas->nama_file }}');"
                                                     onloadstart="this.parentElement.querySelector('.loading-spinner').style.display='flex'; this.style.display='none';">
                                                <div class="error-message" style="display: none;">
                                                    <p class="text-xs text-red-600">Gagal memuat gambar</p>
                                                    <p class="text-xs text-gray-500">File mungkin rusak atau tidak dapat diakses</p>
                                                </div>
                                            </div>
                                        @elseif($extension === 'pdf')
                                            <div class="mb-3 p-4 bg-red-50 border border-red-200 rounded-lg">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <div>
                                                        <p class="text-sm font-medium text-red-800">Dokumen PDF</p>
                                                        <p class="text-xs text-red-600">Klik tombol "Lihat File" untuk membuka</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="mb-3 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-800">Dokumen {{ strtoupper($extension) }}</p>
                                                        <p class="text-xs text-gray-600">Klik tombol untuk mengunduh atau melihat file</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <div class="flex gap-2 flex-wrap">
                                            <a href="{{ $fileUrl }}" 
                                               target="_blank" 
                                               class="inline-flex items-center justify-center w-8 h-8 text-white transition-all bg-transparent border-0 rounded shadow-none cursor-pointer text-sm ease-soft-in bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 active:opacity-85"
                                               onclick="trackFileView('{{ $berkas->nama_file }}', '{{ $berkas->jenis }}')">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ $fileUrl }}" 
                                               download="{{ $berkas->jenis }}_{{ $pendaftar->no_pendaftaran }}.{{ $extension }}" 
                                               class="inline-flex items-center justify-center w-8 h-8 text-white transition-all bg-transparent border-0 rounded shadow-none cursor-pointer text-sm ease-soft-in bg-gradient-to-tl from-green-600 to-lime-400 hover:scale-102 active:opacity-85"
                                               onclick="trackFileDownload('{{ $berkas->nama_file }}', '{{ $berkas->jenis }}')">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            @if(!$berkas->valid)
                                                <button onclick="validateFile({{ $berkas->id }}, '{{ $berkas->jenis }}')" 
                                                        class="inline-block px-4 py-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-gradient-to-tl from-purple-600 to-pink-400 hover:scale-102 active:opacity-85">
                                                    <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Validasi
                                                </button>
                                            @endif
                                        </div>
                                        
                                        @if($berkas->catatan)
                                            <div class="mt-2 p-2 bg-yellow-50 border border-yellow-200 rounded">
                                                <p class="text-xs text-yellow-800"><strong>Catatan:</strong> {{ $berkas->catatan }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-8">
                                        <svg class="mx-auto w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-sm text-slate-500 mb-2">Tidak ada berkas yang diupload</p>
                                        <p class="text-xs text-slate-400">Pendaftar belum mengupload dokumen yang diperlukan</p>
                                        @if(request()->has('debug'))
                                            <div class="mt-4 p-3 bg-gray-100 rounded text-left text-xs">
                                                <p><strong>Debug Info:</strong></p>
                                                <p>Pendaftar ID: {{ $pendaftar->id }}</p>
                                                <p>Total Berkas: {{ $pendaftar->berkas->count() }}</p>
                                                <p>User ID: {{ $pendaftar->user_id }}</p>
                                            </div>
                                        @else
                                            <a href="{{ route('admin.pendaftar.show', $pendaftar->id) }}?debug=1" class="text-xs text-blue-500 underline">Debug Info</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Update Status -->
                @if(!in_array(session('admin_role'), ['admin', 'kepsek']))
                <div class="mt-6">
                    <div class="status-update-section">
                        <div class="status-update-header">
                            <h3><i class="fas fa-edit"></i> Update Status Pendaftar</h3>
                        </div>
                        <div class="status-update-body">
                            <div class="status-buttons">
                                <form action="{{ route('admin.pendaftar.updateStatus', $pendaftar->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status_berkas" value="DITERIMA">
                                    <button type="submit" class="btn-status btn-terima">
                                        <i class="fas fa-thumbs-up"></i> Terima Berkas
                                    </button>
                                </form>
                                <button type="button" onclick="showRejectModal()" class="btn-status btn-tolak">
                                    <i class="fas fa-times"></i> Tolak Berkas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                

            </div>
        </div>
    </div>
</div>
@endsection

<script>
// Convert coordinates to address
function convertCoordinatesToAddress() {
    const alamatElement = document.querySelector('[id^="alamat-display-"]');
    if (!alamatElement) return;
    
    const lat = alamatElement.getAttribute('data-lat');
    const lng = alamatElement.getAttribute('data-lng');
    const currentText = alamatElement.textContent.trim();
    
    // Check if current text contains coordinates
    if (lat && lng && (currentText.includes('Lat:') || currentText.includes('Lng:'))) {
        // Use Nominatim (free) for reverse geocoding
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&accept-language=id`)
            .then(response => response.json())
            .then(data => {
                if (data && data.display_name) {
                    alamatElement.textContent = data.display_name;
                }
            })
            .catch(error => {
                console.log('Geocoding failed:', error);
            });
    }
}

// Run conversion when page loads
document.addEventListener('DOMContentLoaded', convertCoordinatesToAddress);


</script>

<!-- Rejection Modal -->
<div id="rejectModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 12px; padding: 24px; width: 90%; max-width: 500px; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 16px; color: #dc2626;">
            <i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i>Tolak Berkas
        </h3>
        <form action="{{ route('admin.pendaftar.updateStatus', $pendaftar->id) }}" method="POST" id="formTolakBerkas">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status_berkas" value="DITOLAK">
            
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 8px;">Alasan Penolakan Berkas *</label>
                <textarea name="alasan_tolak_berkas" id="alasan_tolak_berkas" rows="4" 
                          style="width: 100%; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.875rem;" 
                          placeholder="Contoh: Foto tidak jelas, KTP tidak terbaca, dokumen tidak lengkap, dll." required></textarea>
                <small style="color: #6b7280; font-size: 0.75rem;">Minimal 10 karakter, maksimal 500 karakter</small>
            </div>
            
            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <button type="button" onclick="hideRejectModal()" 
                        style="padding: 8px 16px; color: #4b5563; background: #e5e7eb; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;">
                    Batal
                </button>
                <button type="submit" 
                        style="padding: 8px 16px; color: white; background: #dc2626; border: none; border-radius: 6px; cursor: pointer; font-weight: 500;">
                    <i class="fas fa-times" style="margin-right: 8px;"></i>Tolak Berkas
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showRejectModal() {
    var modal = document.getElementById('rejectModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function hideRejectModal() {
    var modal = document.getElementById('rejectModal');
    modal.style.display = 'none';
    document.getElementById('alasan_tolak_berkas').value = '';
    document.body.style.overflow = 'auto';
}

// Validate form before submit
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('rejectModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                hideRejectModal();
            }
        });
    }
    
    var form = document.getElementById('formTolakBerkas');
    if (form) {
        form.addEventListener('submit', function(e) {
            var alasan = document.getElementById('alasan_tolak_berkas').value.trim();
            if (alasan.length < 10) {
                e.preventDefault();
                alert('Alasan penolakan minimal 10 karakter');
                return false;
            }
            if (alasan.length > 500) {
                e.preventDefault();
                alert('Alasan penolakan maksimal 500 karakter');
                return false;
            }
        });
    }
});
</script>


