@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">💳 Pembayaran Pendaftaran</h3>
                    <p class="mb-0">SMK BAKTI NUSANTARA 666</p>
                </div>
                
                <div class="card-body p-5">
                    <!-- Info Pendaftaran -->
                    <div class="alert alert-info mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>No. Pendaftaran:</strong> {{ $pendaftar->no_pendaftaran }}<br>
                                <strong>Nama:</strong> {{ $pendaftar->dataSiswa->nama }}
                            </div>
                            <div class="col-md-6">
                                <strong>Jurusan:</strong> {{ $pendaftar->jurusan->nama }}<br>
                                <strong>Gelombang:</strong> {{ $pendaftar->gelombang->nama }}
                            </div>
                        </div>
                    </div>

                    <!-- Info Pembayaran -->
                    <div class="card mb-4 border-warning">
                        <div class="card-body">
                            <h5 class="text-warning mb-3">💰 Informasi Pembayaran</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Biaya Pendaftaran:</strong></p>
                                    <h4 class="text-success">Rp {{ number_format($pendaftar->gelombang->biaya_daftar, 0, ',', '.') }}</h4>
                                    <small class="text-muted">{{ $pendaftar->gelombang->nama }} - {{ $pendaftar->gelombang->tahun }}</small>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Transfer ke:</strong></p>
                                    <p class="mb-1">Bank BCA: <strong>1234567890</strong></p>
                                    <p class="mb-1">a.n. SMK BAKTI NUSANTARA 666</p>
                                    <small class="text-muted">Pastikan nominal transfer sesuai</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($pembayaran && strtolower($pembayaran->status) == 'pending')
                        <div class="alert alert-warning">
                            <i class="fas fa-clock me-2"></i>
                            Bukti pembayaran Anda sedang dalam proses verifikasi. Mohon tunggu konfirmasi dari admin.
                        </div>
                    @elseif($pembayaran && strtolower($pembayaran->status) == 'verified')
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            Pembayaran Anda telah diverifikasi. Pendaftaran berhasil!
                        </div>
                    @else
                        <!-- Form Upload Bukti -->
                        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="pendaftar_id" value="{{ $pendaftar->id }}">
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Upload Bukti Pembayaran *</label>
                                <div class="border-2 border-dashed border-primary rounded p-4 text-center">
                                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" 
                                           class="form-control @error('bukti_pembayaran') is-invalid @enderror" 
                                           accept="image/*" required>
                                    <small class="text-muted d-block mt-2">
                                        Format: JPG, JPEG, PNG | Max: 2MB
                                    </small>
                                </div>
                                @error('bukti_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Nominal Transfer *</label>
                                <input type="number" name="nominal" class="form-control @error('nominal') is-invalid @enderror" 
                                       value="{{ $pendaftar->gelombang->biaya_daftar }}" readonly required>
                                <small class="text-muted">Nominal sesuai biaya gelombang {{ $pendaftar->gelombang->nama }}</small>
                                @error('nominal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Tanggal Transfer *</label>
                                <input type="date" name="tanggal_transfer" class="form-control @error('tanggal_transfer') is-invalid @enderror" 
                                       value="{{ date('Y-m-d') }}" required>
                                @error('tanggal_transfer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Catatan (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="3" 
                                          placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                            </div>

                            <div class="alert alert-warning mb-4">
                                <h6 class="mb-2">⚠️ Penting:</h6>
                                <p class="mb-1">• Transfer sesuai nominal yang tertera</p>
                                <p class="mb-1">• Upload bukti transfer yang jelas</p>
                                <p class="mb-0">• Pembayaran akan diverifikasi dalam 1-2 hari kerja</p>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg" id="submitBtn">
                                    <i class="fas fa-upload me-2"></i>Upload Bukti Pembayaran
                                </button>
                                <a href="{{ route('siswa.dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        if (file.size > 2048000) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            this.value = '';
        }
    }
});

// Loading state untuk tombol submit
document.querySelector('form').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengupload...';
    submitBtn.disabled = true;
});
</script>
@endsection