@extends('layouts.main')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Pendaftaran Ditolak</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-danger">
                            <h5><i class="fas fa-times-circle me-2"></i>Pendaftaran Anda Ditolak</h5>
                            <p class="mb-0">Pendaftaran dengan nomor <strong>{{ $pendaftar->no_pendaftaran }}</strong> telah ditolak oleh admin.</p>
                        </div>

                        <div class="mb-4">
                            <h6>Alasan Penolakan:</h6>
                            <div class="alert alert-warning">
                                {{ $pendaftar->alasan_penolakan ?? 'Tidak ada alasan yang diberikan' }}
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6>Data Pendaftaran:</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="200">No. Pendaftaran</td>
                                    <td>: {{ $pendaftar->no_pendaftaran }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>: {{ $pendaftar->dataSiswa->nama_lengkap ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td>: {{ $pendaftar->jurusan->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Gelombang</td>
                                    <td>: {{ $pendaftar->gelombang->nama ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Langkah Selanjutnya:</h6>
                            <ol class="mb-0">
                                <li>Perbaiki data atau berkas sesuai alasan penolakan di atas</li>
                                <li>Pastikan semua data sudah benar dan lengkap</li>
                                <li>Klik tombol "Kirim Ulang Pendaftaran" untuk mengirim ulang</li>
                            </ol>
                        </div>

                        <form method="POST" action="{{ route('perbaikan.update') }}" onsubmit="return confirm('Apakah Anda yakin ingin mengirim ulang pendaftaran ini?')">
                            @csrf
                            <div class="text-center">
                                <a href="{{ route('siswa.dashboard') }}" class="btn btn-secondary me-3">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Ulang Pendaftaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection