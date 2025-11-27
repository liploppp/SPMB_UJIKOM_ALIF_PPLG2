@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            @if($pendaftar)
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">📋 Status Pendaftaran</h3>
                    <p class="mb-0">{{ $pendaftar->siswa_nama }}</p>
                </div>
                
                <div class="card-body p-4">
                    @php
                        $statusBerkas = $pendaftar->status_berkas ?? 'SUBMIT';
                        $statusPembayaran = $pembayaran ? strtolower($pembayaran->status) : null;
                        $jumlahBerkas = 0; // Cannot count from query result
                    @endphp
                    
                    <!-- Status Pendaftaran -->
                    <div class="alert alert-info mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>No. Pendaftaran:</strong> {{ $pendaftar->no_pendaftaran }}<br>
                                <strong>Jurusan:</strong> {{ $pendaftar->jurusan_nama }}
                            </div>
                            <div class="col-md-6">
                                <strong>Status Berkas:</strong> 
                                @if($statusBerkas == 'DITERIMA')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif($statusBerkas == 'DITOLAK')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-warning">Menunggu Verifikasi</span>
                                @endif
                                <br>
                                <strong>Status Pembayaran:</strong> 
                                @if($pembayaran)
                                    @if(strtolower($pembayaran->status) == 'verified')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif(strtolower($pembayaran->status) == 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Belum Upload</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if($statusBerkas == 'DITOLAK' && $pendaftar->alasan_tolak_berkas)
                        <div class="alert alert-danger mb-4">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Berkas Ditolak</h6>
                            <p class="mb-0"><strong>Alasan:</strong> {{ $pendaftar->alasan_tolak_berkas }}</p>
                        </div>
                    @endif
                    
                    @if($pembayaran && strtolower($pembayaran->status) == 'rejected' && $pembayaran->alasan_tolak_pembayaran)
                        <div class="alert alert-danger mb-4">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Pembayaran Ditolak</h6>
                            <p class="mb-0"><strong>Alasan:</strong> {{ $pembayaran->alasan_tolak_pembayaran }}</p>
                        </div>
                    @endif

                    <!-- Progress Steps -->
                    <div class="mb-4">
                        <h5>Progress Pendaftaran:</h5>
                        <div class="progress-steps">
                            <div class="step completed">
                                <div class="step-icon">✓</div>
                                <div class="step-text">Pendaftaran</div>
                            </div>
                            <div class="step completed">
                                <div class="step-icon">✓</div>
                                <div class="step-text">Upload Berkas</div>
                            </div>
                            <div class="step {{ $pembayaran ? 'completed' : 'active' }}">
                                <div class="step-icon">{{ $pembayaran ? '✓' : '3' }}</div>
                                <div class="step-text">Pembayaran</div>
                            </div>
                            <div class="step {{ $statusPembayaran == 'verified' ? 'completed' : '' }}">
                                <div class="step-icon">{{ $statusPembayaran == 'verified' ? '✓' : '4' }}</div>
                                <div class="step-text">Verifikasi</div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row g-3 mt-3">
                        @if($statusBerkas == 'DITERIMA' && $statusPembayaran == 'verified')
                            <div class="col-md-6">
                                <a href="/cetak-bukti-pendaftaran/{{ $pendaftar->id }}" class="btn btn-primary w-100" target="_blank">
                                    <i class="fas fa-print me-2"></i>Cetak Bukti Pendaftaran
                                </a>
                            </div>
                        @endif
                    </div>

                    @if($pembayaran && $statusPembayaran == 'verified')
                    <div class="card mt-4 border-success">
                        <div class="card-body">
                            <h6 class="text-success mb-3">💳 Status Pembayaran</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nominal:</strong> Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</p>
                                    <p><strong>Tanggal Transfer:</strong> {{ \Carbon\Carbon::parse($pembayaran->tanggal_transfer)->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Status:</strong> <span class="badge bg-success">Terverifikasi</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @elseif($nisn && $nama)
            <div class="card shadow-lg border-0">
                <div class="card-header bg-danger text-white text-center py-4">
                    <h3 class="mb-0">❌ Data Tidak Ditemukan</h3>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-times-circle me-2"></i>Data Tidak Ditemukan</h6>
                        <p class="mb-0">Data pendaftaran dengan NISN "{{ $nisn }}" dan nama "{{ $nama }}" tidak ditemukan. Pastikan NISN dan nama sudah benar.</p>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-primary"><i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<style>
.progress-steps {
    display: flex;
    justify-content: space-between;
    margin: 20px 0;
}

.step {
    text-align: center;
    flex: 1;
    position: relative;
}

.step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 20px;
    right: -50%;
    width: 100%;
    height: 2px;
    background: #ddd;
    z-index: 1;
}

.step.completed:not(:last-child)::after {
    background: #28a745;
}

.step-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #ddd;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    position: relative;
    z-index: 2;
}

.step.completed .step-icon {
    background: #28a745;
}

.step.active .step-icon {
    background: #007bff;
}

.step-text {
    font-size: 12px;
    font-weight: 500;
}
</style>
@endsection