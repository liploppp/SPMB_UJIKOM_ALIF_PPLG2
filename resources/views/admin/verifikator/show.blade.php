@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Verifikasi - {{ $pendaftaran->dataSiswa->nama ?? 'N/A' }}</h2>
        <a href="{{ route('admin.verifikator.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Data Pribadi -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Data Pribadi</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm">
                                <tr><td>Nama Lengkap</td><td>: {{ $pendaftaran->dataSiswa->nama ?? 'N/A' }}</td></tr>
                                <tr><td>NISN</td><td>: {{ $pendaftaran->dataSiswa->nisn ?? 'N/A' }}</td></tr>
                                <tr><td>NIK</td><td>: {{ $pendaftaran->dataSiswa->nik ?? 'N/A' }}</td></tr>
                                <tr><td>Tempat, Tgl Lahir</td><td>: {{ $pendaftaran->dataSiswa->tmp_lahir ?? 'N/A' }}, {{ $pendaftaran->dataSiswa->tgl_lahir ?? 'N/A' }}</td></tr>
                                <tr><td>Jenis Kelamin</td><td>: {{ $pendaftaran->dataSiswa->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm">
                                <tr><td>Alamat</td><td>: {{ $pendaftaran->dataSiswa->alamat ?? 'N/A' }}</td></tr>
                                <tr><td>No HP</td><td>: {{ $pendaftaran->pengguna->hp ?? 'N/A' }}</td></tr>
                                <tr><td>Jurusan</td><td>: {{ $pendaftaran->jurusan->nama }}</td></tr>
                                <tr><td>Asal Sekolah</td><td>: {{ $pendaftaran->asalSekolah->nama_sekolah ?? 'N/A' }}</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berkas -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Berkas Pendukung</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($pendaftaran->berkas as $berkas)
                        <div class="col-md-6 mb-2">
                            <a href="{{ route('file.show', $berkas->nama_file) }}" 
                               target="_blank" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-file"></i> {{ $berkas->jenis }}
                                @if($berkas->valid)
                                    <i class="fas fa-check-circle text-success ms-1"></i>
                                @endif
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Status -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5>Status Verifikasi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        Status Saat Ini: 
                        @if($pendaftaran->status === 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($pendaftaran->status === 'verified')
                            <span class="badge bg-success">Terverifikasi</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </div>

                    @if(session('admin_role') === 'verifikator_adm')
                    <form method="POST" action="{{ route('admin.verifikator.updateStatus', $pendaftaran->id) }}">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label class="form-label">Ubah Status</label>
                            <select name="status" class="form-select" required>
                                <option value="">Pilih Status</option>
                                <option value="verified">Terverifikasi</option>
                                <option value="rejected">Ditolak</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3" 
                                      placeholder="Catatan verifikasi (opsional)">{{ $pendaftaran->catatan_verifikasi }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            Update Status
                        </button>
                    </form>
                    @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Hanya Verifikator yang dapat mengubah status pendaftar.
                    </div>
                    @endif
                </div>
            </div>

            @if(session('admin_role') === 'verifikator_adm')
            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.verifikator.updateStatus', $pendaftaran->id) }}" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="verified">
                        <button type="submit" class="btn btn-success btn-sm w-100 mb-2">
                            <i class="fas fa-check"></i> Verifikasi
                        </button>
                    </form>
                    
                    <form method="POST" action="{{ route('admin.verifikator.updateStatus', $pendaftaran->id) }}" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger btn-sm w-100">
                            <i class="fas fa-times"></i> Tolak
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection