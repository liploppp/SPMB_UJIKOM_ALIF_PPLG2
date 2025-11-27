@extends('layouts.auth')

@section('content')
<div class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg, #ff4880 0%, #ff4880 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                    <div class="card-body p-5">
                        <!-- Logo & Title -->
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <i class="fas fa-user-plus fa-3x text-primary"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-1">Daftar Akun Siswa</h3>
                            <p class="text-muted">SMK BAKTINUSANTARA 666</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger border-0 rounded-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success border-0 rounded-3">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        <!-- OTP Form (Hidden by default) -->
                        @if(session('show_otp'))
                        <div id="otpSection" class="mb-4">
                            <div class="text-center mb-3">
                                <i class="fas fa-envelope-open fa-2x text-primary mb-2"></i>
                                <h5 class="fw-bold text-dark">Verifikasi Email</h5>
                                <p class="text-muted small">Kode OTP telah dikirim ke <strong>{{ session('otp_email') }}</strong></p>
                            </div>
                            <form method="POST" action="{{ route('siswa.verify-otp') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark">
                                        <i class="fas fa-key me-2 text-primary"></i>Kode OTP (6 digit)
                                    </label>
                                    <input type="text" name="otp_code" class="form-control form-control-lg text-center border-0 shadow-sm" 
                                           style="border-radius: 15px; background-color: #f8f9fa; font-size: 1.5rem; letter-spacing: 0.5rem;" 
                                           placeholder="000000" maxlength="6" required>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg w-100 fw-semibold shadow" 
                                        style="border-radius: 15px;">
                                    <i class="fas fa-check me-2"></i>Verifikasi OTP
                                </button>
                            </form>
                        </div>
                        @else
                        <!-- Registration Form -->
                        <form method="POST" action="{{ route('siswa.register') }}" id="registerForm">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-user me-2 text-primary"></i>Nama Lengkap
                            </label>
                            <input type="text" name="nama_lengkap" class="form-control form-control-lg border-0 shadow-sm" 
                                   style="border-radius: 15px; background-color: #f8f9fa;" 
                                   placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email
                            </label>
                            <input type="email" name="email" class="form-control form-control-lg border-0 shadow-sm" 
                                   style="border-radius: 15px; background-color: #f8f9fa;" 
                                   placeholder="Masukkan email" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-phone me-2 text-primary"></i>No. HP
                            </label>
                            <input type="text" name="no_hp" class="form-control form-control-lg border-0 shadow-sm" 
                                   style="border-radius: 15px; background-color: #f8f9fa;" 
                                   placeholder="Masukkan nomor HP" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-lock me-2 text-primary"></i>Password
                            </label>
                            <input type="password" name="password" class="form-control form-control-lg border-0 shadow-sm" 
                                   style="border-radius: 15px; background-color: #f8f9fa;" 
                                   placeholder="Masukkan password" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="fas fa-lock me-2 text-primary"></i>Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg border-0 shadow-sm" 
                                   style="border-radius: 15px; background-color: #f8f9fa;" 
                                   placeholder="Konfirmasi password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold shadow" 
                                style="border-radius: 15px;">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </button>
                        </form>
                        @endif
                    
                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <span class="text-muted">Sudah punya akun? </span>
                            <a href="{{ route('auth.login') }}" class="text-primary fw-semibold text-decoration-none">
                                Login di sini
                            </a>
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

@include('partials.otp-script')
@endsection