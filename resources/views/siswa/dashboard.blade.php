@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">📋 Dashboard Siswa</h3>
                    <p class="mb-0">{{ Session::get('siswa_nama') }}</p>
                </div>
                
                <div class="card-body p-4">
                    @if($pendaftar)
                        @php
                            $jumlahBerkas = $pendaftar->berkas->count();
                            $statusPembayaran = $pembayaran ? strtolower($pembayaran->status) : null;
                        @endphp
                        
                        <!-- Status Pendaftaran -->
                        <div class="alert alert-info mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>No. Pendaftaran:</strong> {{ $pendaftar->no_pendaftaran }}<br>
                                    <strong>Jurusan:</strong> {{ $pendaftar->jurusan->nama }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Status Berkas:</strong> 
                                    @if($pendaftar->status_berkas == 'DITERIMA')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($pendaftar->status_berkas == 'DITOLAK')
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
                        
                        @if($pendaftar->status_berkas == 'DITOLAK' && $pendaftar->alasan_tolak_berkas)
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
                                <div class="step {{ $jumlahBerkas > 0 ? 'completed' : 'active' }}">
                                    <div class="step-icon">{{ $jumlahBerkas > 0 ? '✓' : '2' }}</div>
                                    <div class="step-text">Upload Berkas ({{ $jumlahBerkas }})</div>
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
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('ppdb.upload-berkas-form') }}" class="btn btn-warning w-100">
                                    <i class="fas fa-upload me-2"></i>Upload Berkas ({{ $jumlahBerkas }})
                                </a>
                            </div>
                            
                            @if($pendaftar->status_berkas == 'DITERIMA' && (!$pembayaran || strtolower($pembayaran->status) == 'rejected'))
                                <div class="col-md-6">
                                    <a href="{{ route('pembayaran') }}" class="btn btn-success w-100">
                                        <i class="fas fa-credit-card me-2"></i>{{ $pembayaran && strtolower($pembayaran->status) == 'rejected' ? 'Upload Ulang Pembayaran' : 'Upload Bukti Pembayaran' }}
                                    </a>
                                </div>
                            @elseif($pendaftar->status_berkas == 'DITOLAK')
                                <div class="col-md-6">
                                    <div class="alert alert-danger mb-0">
                                        <i class="fas fa-times-circle me-2"></i>Berkas ditolak, upload ulang
                                    </div>
                                </div>
                            @elseif($pendaftar->status_berkas == 'SUBMIT')
                                <div class="col-md-6">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-hourglass-half me-2"></i>Menunggu verifikasi berkas
                                    </div>
                                </div>
                            @elseif($pembayaran && $statusPembayaran == 'pending' && $pendaftar->status_berkas == 'DITERIMA')
                                <div class="col-md-6">
                                    <div class="alert alert-warning mb-0">
                                        <i class="fas fa-clock me-2"></i>Bukti pembayaran sedang diverifikasi
                                    </div>
                                </div>
                            @elseif($pembayaran && $statusPembayaran == 'rejected')
                                <div class="col-md-6">
                                    <div class="alert alert-danger mb-0">
                                        <i class="fas fa-times-circle me-2"></i>Pembayaran ditolak
                                    </div>
                                </div>
                            @elseif($pembayaran && $statusPembayaran == 'verified')
                                <div class="col-md-6">
                                    <div class="alert alert-success mb-0">
                                        <i class="fas fa-check-circle me-2"></i>Pembayaran telah diverifikasi
                                    </div>
                                </div>
                            @endif
                            
                            <div class="col-md-6">
                                <a href="{{ route('siswa.cetak-bukti') }}" class="btn btn-primary w-100" target="_blank">
                                    <i class="fas fa-print me-2"></i>Cetak Bukti
                                </a>
                            </div>
                        </div>

                        <!-- Status Pembayaran -->
                        @if($pembayaran)
                            <div class="card mt-4 border-success">
                                <div class="card-body">
                                    <h6 class="text-success mb-3">💳 Status Pembayaran</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Nominal:</strong> Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</p>
                                            <p><strong>Tanggal Transfer:</strong> {{ $pembayaran->tanggal_transfer->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Status:</strong> 
                                                @if($pembayaran->status == 'PENDING')
                                                    <span class="badge bg-warning">Menunggu Verifikasi</span>
                                                @elseif($pembayaran->status == 'VERIFIED')
                                                    <span class="badge bg-success">Terverifikasi</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @else
                        <div class="text-center py-5">
                            <h5>Belum ada data pendaftaran</h5>
                            <p class="text-muted">Silakan lengkapi pendaftaran terlebih dahulu</p>
                            <a href="{{ route('pendaftaran') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Mulai Pendaftaran
                            </a>
                        </div>
                    @endif
                </div>
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