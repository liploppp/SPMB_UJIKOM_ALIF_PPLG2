@extends('layouts.main')

@section('content')
<div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4">Upload Ulang Berkas</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Upload Berkas</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            @if($pendaftar->status_berkas == 'DITOLAK')
                <div class="alert alert-danger">
                    <h5><i class="fas fa-exclamation-triangle me-2"></i>Berkas Ditolak</h5>
                    <p class="mb-2"><strong>Alasan:</strong> {{ $pendaftar->alasan_tolak_berkas }}</p>
                    <p class="mb-0">Silakan upload ulang berkas yang diperlukan di bawah ini.</p>
                </div>
            @endif
            
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-upload me-2"></i>Upload Berkas Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('ppdb.upload-berkas') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <p class="text-muted mb-4">Format: PDF/JPG, maksimal 2MB per file</p>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ijazah/SKHUN <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="berkas_ijazah" accept=".pdf,.jpg,.jpeg" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rapor <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="berkas_rapor" accept=".pdf,.jpg,.jpeg" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="berkas_kk" accept=".pdf,.jpg,.jpeg" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Akta Kelahiran <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="berkas_akta" accept=".pdf,.jpg,.jpeg" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pas Foto <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="berkas_foto" accept=".jpg,.jpeg" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">KIP/KKS (Jika Ada)</label>
                                <input type="file" class="form-control" name="berkas_kip" accept=".pdf,.jpg,.jpeg">
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-upload me-2"></i>Upload Berkas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
