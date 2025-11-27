@extends('layouts.auth')

@section('content')
<div class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, #ff4880 0%, #ff4880 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                    <div class="card-body p-5">
                        <!-- Logo & Title -->
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-1">SMK BAKTINUSANTARA 666</h3>
                            <p class="text-muted">Sistem Informasi SPMB</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger border-0 rounded-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="fas fa-envelope me-2 text-primary"></i>Email
                                </label>
                                <input type="email" name="email" class="form-control form-control-lg border-0 shadow-sm" 
                                       style="border-radius: 15px; background-color: #f8f9fa;" 
                                       placeholder="Masukkan email Anda" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="fas fa-lock me-2 text-primary"></i>Password
                                </label>
                                <input type="password" name="password" class="form-control form-control-lg border-0 shadow-sm" 
                                       style="border-radius: 15px; background-color: #f8f9fa;" 
                                       placeholder="Masukkan password Anda" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold shadow" 
                                    style="border-radius: 15px;">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                            </button>
                        </form>
                        
                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <span class="text-muted">Belum punya akun siswa? </span>
                                <a href="{{ route('auth.register') }}" class="text-primary fw-semibold text-decoration-none">
                                    Daftar Sekarang
                                </a>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Login sebagai Admin atau Siswa menggunakan email dan password yang sesuai</small>
                            </div>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection