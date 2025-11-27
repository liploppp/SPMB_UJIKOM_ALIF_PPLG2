@extends('layouts.admin')

@section('title', 'Data Pendaftar')

@push('styles')
<style>
.stats-card {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 15px;
}

.stats-icon.primary { background: var(--gradient-primary); }
.stats-icon.success { background: linear-gradient(135deg, #4caf50, #2e7d32); }
.stats-icon.warning { background: linear-gradient(135deg, #ff9800, #f57c00); }

.stats-info .value {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin: 0;
    line-height: 1;
}

.stats-info h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #666;
    margin: 8px 0 0 0;
}

.table-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    overflow: hidden;
}

.table-header {
    background: #f8f9fa;
    padding: 16px 20px;
    border-bottom: 1px solid #e9ecef;
}

.table-header h3 {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.5rem;
    margin: 0;
}

.form-control {
    border: 2px solid var(--primary-light);
    border-radius: 15px;
    padding: 10px 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.1);
}

.btn {
    border-radius: 15px;
    font-weight: 600;
    padding: 10px 20px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: var(--gradient-primary);
    border: none;
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(233, 30, 99, 0.3);
}

.btn-secondary {
    background: #6c757d;
    border: none;
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, #f44336, #d32f2f);
    border: none;
    color: white;
}

.btn-danger:hover {
    background: linear-gradient(135deg, #d32f2f, #b71c1c);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(244, 67, 54, 0.4);
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.table-wrapper {
    overflow-x: auto;
    border-radius: 0 0 20px 20px;
}

.admin-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 0;
}

.table th {
    background: #f8f9fa;
    padding: 12px 8px;
    font-weight: 600;
    color: #495057;
    font-size: 0.875rem;
    border-bottom: 2px solid #dee2e6;
    vertical-align: middle;
}

.table td {
    padding: 12px 8px;
    vertical-align: middle;
    font-size: 0.875rem;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 8px;
}

.user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #007bff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.user-avatar-placeholder {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: linear-gradient(135deg, #007bff, #0056b3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.75rem;
    border: 2px solid #007bff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.user-info h6 {
    margin: 0;
    font-size: 0.875rem;
    font-weight: 600;
}

.user-id {
    font-size: 0.75rem;
    color: #6c757d;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.jurusan-badge {
    background: #007bff;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.number-badge {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #007bff;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
}

.status-badge.status-submit {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.status-badge.status-verifikasi {
    background: #cce5ff;
    color: #0056b3;
    border: 1px solid #99d6ff;
}

.status-badge.status-diterima {
    background: #d4edda;
    color: #155724;
    border: 1px solid #a3d977;
}

.status-badge.status-ditolak {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f1aeb5;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--primary-light);
    box-shadow: 0 4px 10px rgba(233, 30, 99, 0.2);
    transition: all 0.3s ease;
}

.user-avatar:hover {
    transform: scale(1.1);
    border-color: var(--primary-color);
}

.user-avatar-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    font-weight: bold;
    border: 3px solid var(--primary-light);
    box-shadow: 0 4px 10px rgba(233, 30, 99, 0.2);
}

.user-info h6 {
    margin: 0 0 4px 0;
    font-weight: 700;
    color: #2d3748;
    font-size: 0.95rem;
}

.user-info .user-id {
    font-size: 0.75rem;
    color: var(--primary-color);
    font-weight: 600;
    background: var(--bg-light);
    padding: 2px 8px;
    border-radius: 12px;
    display: inline-block;
}

.jurusan-info {
    text-align: center;
}

.jurusan-badge {
    background: var(--gradient-primary);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.8rem;
    display: inline-block;
    margin-bottom: 4px;
    box-shadow: 0 2px 8px rgba(233, 30, 99, 0.3);
}

.gelombang-info {
    font-size: 0.7rem;
    color: #666;
    font-weight: 500;
}

.date-info {
    text-align: center;
}

.date-day {
    font-weight: 700;
    color: var(--primary-color);
    font-size: 0.9rem;
    display: block;
}

.date-time {
    font-size: 0.7rem;
    color: #666;
    margin-top: 2px;
}

.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-sm {
    padding: 8px 16px;
    font-size: 0.75rem;
    border-radius: 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.btn-sm:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.number-badge {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: var(--gradient-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.8rem;
    box-shadow: 0 2px 8px rgba(233, 30, 99, 0.3);
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.justify-between {
    justify-content: space-between;
}

.gap-3 {
    gap: 12px;
}

.relative {
    position: relative;
}

.absolute {
    position: absolute;
}

.left-3 {
    left: 12px;
}

.top-1\/2 {
    top: 50%;
}

.transform {
    transform: translateY(-50%);
}

.text-gray-400 {
    color: #9ca3af;
}

.pl-10 {
    padding-left: 40px;
}

.stats-cards-container {
    display: flex !important;
    flex-wrap: nowrap !important;
    gap: 1rem !important;
    margin-bottom: 2rem !important;
}

.stats-cards-container > div {
    flex: 1 !important;
    min-width: 0 !important;
}
</style>
@endpush

@section('content')
<!-- Statistics Cards -->
<div class="stats-cards-container">
    <div>
        <div class="stats-card fade-in-up">
            <div class="stats-icon primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="stats-info">
                <p class="value">{{ number_format($pendaftars->total()) }}</p>
                <h4>Total Pendaftar</h4>
            </div>
        </div>
    </div>
    
    <div>
        <div class="stats-card fade-in-up" style="animation-delay: 0.1s">
            <div class="stats-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stats-info">
                <p class="value">{{ number_format($pendaftars->where('status', 'DITERIMA')->count()) }}</p>
                <h4>Diterima</h4>
            </div>
        </div>
    </div>
    
    <div>
        <div class="stats-card fade-in-up" style="animation-delay: 0.2s">
            <div class="stats-icon primary">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stats-info">
                <p class="value">{{ number_format($pendaftars->where('status', 'VERIFIKASI')->count()) }}</p>
                <h4>Verifikasi</h4>
            </div>
        </div>
    </div>
    
    <div>
        <div class="stats-card fade-in-up" style="animation-delay: 0.3s">
            <div class="stats-icon warning">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stats-info">
                <p class="value">{{ number_format($pendaftars->where('status', 'SUBMIT')->count()) }}</p>
                <h4>Pending</h4>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-1/2 max-w-full px-3">
                        <h6>Data Pendaftar PPDB</h6>
                        <p class="mb-0 text-sm leading-normal">Kelola data calon siswa yang mendaftar</p>
                    </div>
                    <div class="flex-none w-1/2 max-w-full px-3 text-right">
                        <form method="GET" class="flex items-center justify-end gap-3">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/no pendaftaran..." class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding pl-10 pr-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" style="min-width: 250px;">
                            </div>
                            <select name="status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                                <option value="">Semua Status</option>
                                <option value="SUBMIT" {{ request('status') == 'SUBMIT' ? 'selected' : '' }}>Submit</option>
                                <option value="VERIFIKASI" {{ request('status') == 'VERIFIKASI' ? 'selected' : '' }}>Verifikasi</option>
                                <option value="DITERIMA" {{ request('status') == 'DITERIMA' ? 'selected' : '' }}>Diterima</option>
                                <option value="DITOLAK" {{ request('status') == 'DITOLAK' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit" class="inline-block px-4 py-2 mb-0 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500">
                                <i class="fas fa-search mr-1"></i>Cari
                            </button>
                            @if(request('search') || request('status'))
                                <a href="{{ route('admin.pendaftar.index') }}" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-slate-600 bg-none text-slate-600 hover:border-slate-600">
                                    <i class="fas fa-times mr-1"></i>Reset
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            
            @if(session('success'))
                <div data-success-message="{{ session('success') }}" style="display: none;"></div>
            @endif
            
            @if(session('error'))
                <div data-error-message="{{ session('error') }}" style="display: none;"></div>
            @endif
            
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="width: 60px;">#</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="min-width: 280px;">Pendaftar</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="width: 150px;">Jurusan</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="width: 120px;">Status</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="width: 120px;">Tanggal</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70" style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftars as $index => $pendaftar)
                            <tr>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="inline-flex items-center justify-center w-8 h-8 text-white transition-all duration-200 ease-soft-in-out text-sm rounded-xl bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <span class="font-bold text-xs">{{ ($pendaftars->currentPage() - 1) * $pendaftars->perPage() + $index + 1 }}</span>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        @php
                                            $foto = $pendaftar->berkas->where('jenis', 'FOTO')->first();
                                        @endphp
                                        
                                        <div class="mr-4">
                                            @if($foto)
                                                <img src="{{ url('berkas.php?file=' . $foto->nama_file) }}" 
                                                     alt="Foto {{ $pendaftar->dataSiswa->nama ?? 'Pendaftar' }}" 
                                                     class="inline-flex items-center justify-center w-12 h-12 text-white transition-all duration-200 ease-soft-in-out text-sm rounded-xl object-cover border-2 border-purple-200" 
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                                     loading="lazy">
                                                <div class="inline-flex items-center justify-center w-12 h-12 text-white transition-all duration-200 ease-soft-in-out text-sm rounded-xl bg-gradient-to-tl from-purple-700 to-pink-500" style="display: none;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @else
                                                <div class="inline-flex items-center justify-center w-12 h-12 text-white transition-all duration-200 ease-soft-in-out text-sm rounded-xl bg-gradient-to-tl from-purple-700 to-pink-500">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal font-semibold">{{ $pendaftar->dataSiswa->nama ?? 'Nama tidak tersedia' }}</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">{{ $pendaftar->no_pendaftaran }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="bg-gradient-to-tl from-blue-600 to-cyan-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        {{ $pendaftar->jurusan->kode ?? '-' }}
                                    </span>
                                    <p class="mb-0 text-xs leading-tight text-slate-400 mt-1">{{ $pendaftar->gelombang->nama ?? '-' }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($pendaftar->status_berkas == 'DITERIMA')
                                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            <i class="fas fa-check mr-1"></i>{{ $pendaftar->status_berkas }}
                                        </span>
                                    @elseif($pendaftar->status_berkas == 'DITOLAK')
                                        <span class="bg-gradient-to-tl from-red-600 to-rose-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            <i class="fas fa-times mr-1"></i>{{ $pendaftar->status_berkas }}
                                        </span>
                                    @elseif($pendaftar->status_berkas == 'VERIFIKASI')
                                        <span class="bg-gradient-to-tl from-blue-600 to-cyan-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            <i class="fas fa-clock mr-1"></i>{{ $pendaftar->status_berkas }}
                                        </span>
                                    @else
                                        <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            <i class="fas fa-hourglass-half mr-1"></i>{{ $pendaftar->status_berkas ?? 'SUBMIT' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight">{{ $pendaftar->created_at->format('d/m/Y') }}</p>
                                    <p class="mb-0 text-xs leading-tight text-slate-400">{{ $pendaftar->created_at->format('H:i') }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.pendaftar.show', $pendaftar->id) }}" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500" title="Lihat detail pendaftar">
                                            <i class="fas fa-eye mr-1"></i>Detail
                                        </a>
                                        <form action="{{ route('admin.pendaftar.destroy', $pendaftar->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDeletePendaftar(this.closest('form'), '{{ addslashes($pendaftar->dataSiswa->nama ?? 'Unknown') }}', '{{ $pendaftar->no_pendaftaran }}')" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-red-500 bg-none text-red-500 hover:border-red-500" title="Hapus data pendaftar">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 mb-4 bg-gradient-to-tl from-gray-400 to-gray-200 rounded-full flex items-center justify-center">
                                            <i class="fas fa-users text-2xl text-white"></i>
                                        </div>
                                        <h6 class="mb-1 text-slate-600">Tidak ada data pendaftar</h6>
                                        <p class="text-xs text-slate-400">Belum ada pendaftar yang terdaftar dalam sistem</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($pendaftars->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-slate-500">
                            Menampilkan <span class="font-semibold text-slate-700">{{ $pendaftars->firstItem() }}</span> sampai <span class="font-semibold text-slate-700">{{ $pendaftars->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $pendaftars->total() }}</span> hasil
                        </div>
                        <div class="flex items-center space-x-1">
                            @if ($pendaftars->onFirstPage())
                                <span class="px-3 py-2 text-xs font-bold text-slate-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                </span>
                            @else
                                <a href="{{ $pendaftars->previousPageUrl() }}" class="px-3 py-2 text-xs font-bold text-white bg-gradient-to-tl from-slate-600 to-slate-300 rounded-lg hover:scale-102 transition-all">
                                    <i class="fas fa-chevron-left mr-1"></i> Sebelumnya
                                </a>
                            @endif
                            
                            @foreach ($pendaftars->getUrlRange(max(1, $pendaftars->currentPage() - 2), min($pendaftars->lastPage(), $pendaftars->currentPage() + 2)) as $page => $url)
                                @if ($page == $pendaftars->currentPage())
                                    <span class="px-3 py-2 text-xs font-bold text-white bg-gradient-to-tl from-purple-700 to-pink-500 rounded-lg">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-3 py-2 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-all">{{ $page }}</a>
                                @endif
                            @endforeach
                            
                            @if ($pendaftars->hasMorePages())
                                <a href="{{ $pendaftars->nextPageUrl() }}" class="px-3 py-2 text-xs font-bold text-white bg-gradient-to-tl from-slate-600 to-slate-300 rounded-lg hover:scale-102 transition-all">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                </a>
                            @else
                                <span class="px-3 py-2 text-xs font-bold text-slate-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    Selanjutnya <i class="fas fa-chevron-right ml-1"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDeletePendaftar(form, nama, noPendaftaran) {
    // Use SweetAlert2 for better UX with Soft UI styling
    Swal.fire({
        title: 'Konfirmasi Hapus Data',
        html: `
            <div class="text-center">
                <div class="mb-4">
                    <i class="fas fa-user-times text-6xl text-red-500 mb-4"></i>
                </div>
                <p class="text-lg mb-4">Apakah Anda yakin ingin menghapus data pendaftar?</p>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-4">
                    <div class="text-left">
                        <p class="mb-2"><strong>Nama:</strong> ${nama}</p>
                        <p class="mb-0"><strong>No. Pendaftaran:</strong> ${noPendaftaran}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Data yang dihapus tidak dapat dikembalikan dan semua file berkas akan ikut terhapus.
                </p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-trash mr-2"></i>Ya, Hapus Data',
        cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        customClass: {
            popup: 'rounded-2xl shadow-2xl',
            confirmButton: 'rounded-lg px-6 py-3 font-semibold',
            cancelButton: 'rounded-lg px-6 py-3 font-semibold'
        },
        buttonsStyling: true,
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading state
            Swal.fire({
                title: 'Menghapus Data...',
                html: '<div class="text-center"><i class="fas fa-spinner fa-spin text-4xl text-blue-500 mb-4"></i><p>Mohon tunggu, sedang menghapus data pendaftar...</p></div>',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-2xl shadow-2xl'
                }
            });
            
            // Submit form after short delay
            setTimeout(() => {
                form.submit();
            }, 500);
        }
    });
}

// Auto hide alerts and show notifications
document.addEventListener('DOMContentLoaded', function() {
    const successMsg = document.querySelector('[data-success-message]');
    const errorMsg = document.querySelector('[data-error-message]');
    
    if (successMsg) {
        const msg = successMsg.getAttribute('data-success-message');
        showNotification(msg, 'success');
    }
    
    if (errorMsg) {
        const msg = errorMsg.getAttribute('data-error-message');
        showNotification(msg, 'error');
    }
});

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 350px; border-radius: 15px;';
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2" style="font-size: 1.2rem;"></i>
            <div class="flex-grow-1">${message}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Add loading state to action buttons
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        if (this.type === 'submit' && !this.classList.contains('btn-danger')) {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memproses...';
            this.disabled = true;
            
            // Re-enable after 3 seconds as fallback
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 3000);
        }
    });
});
</script>
@endpush