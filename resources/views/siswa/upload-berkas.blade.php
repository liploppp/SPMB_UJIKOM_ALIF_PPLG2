@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">📁 Upload Berkas Pendaftaran</h3>
                    <p class="mb-0">{{ $pendaftar->dataSiswa->nama }}</p>
                </div>
                
                <div class="card-body p-5">
                    <div class="alert alert-info mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>No. Pendaftaran:</strong> {{ $pendaftar->no_pendaftaran }}<br>
                                <strong>Jurusan:</strong> {{ $pendaftar->jurusan->nama }}
                            </div>
                            <div class="col-md-6">
                                <strong>Berkas Terupload:</strong> {{ $pendaftar->berkas->count() }} file
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('ppdb.upload-berkas') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Jenis Berkas *</label>
                            <select name="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                                <option value="">Pilih Jenis Berkas</option>
                                <option value="FOTO">Pas Foto 3x4</option>
                                <option value="IJAZAH">Ijazah/SKHUN</option>
                                <option value="RAPOR">Rapor</option>
                                <option value="KK">Kartu Keluarga</option>
                                <option value="AKTA">Akta Kelahiran</option>
                                <option value="KIP">KIP/KKS (Opsional)</option>
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Upload File *</label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="image/*,.pdf" required>
                            <small class="text-muted">Format: JPG, JPEG, PNG, PDF | Max: 2MB</small>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-warning mb-4">
                            <h6 class="mb-2">⚠️ Penting:</h6>
                            <p class="mb-1">• Pastikan file yang diupload jelas dan terbaca</p>
                            <p class="mb-1">• Ukuran file maksimal 2MB</p>
                            <p class="mb-0">• Format yang diterima: JPG, JPEG, PNG, PDF</p>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-upload me-2"></i>Upload Berkas
                            </button>
                            <a href="{{ route('siswa.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    </form>

                    @if($pendaftar->berkas->count() > 0)
                        <hr class="my-4">
                        <h5 class="mb-3">Berkas yang Sudah Diupload:</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Jenis</th>
                                        <th>Nama File</th>
                                        <th>Ukuran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendaftar->berkas as $berkas)
                                    <tr>
                                        <td>{{ $berkas->jenis }}</td>
                                        <td>{{ $berkas->nama_file }}</td>
                                        <td>{{ $berkas->ukuran_kb }} KB</td>
                                        <td>
                                            @if($berkas->valid)
                                                <span class="badge bg-success">Valid</span>
                                            @else
                                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
