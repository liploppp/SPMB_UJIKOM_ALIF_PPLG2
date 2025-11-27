@extends('layouts.main')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4">Program Jurusan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Jurusan</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Jurusan Start -->
<div id="jurusan" class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeIn" data-wow-delay="0.1s">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                Keunggulan Jurusan
            </h4>
            <h1 class="text-dark mb-4 display-5">Program Keahlian di SMK BAKTI NUSANTARA 666</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-white text-center p-4 rounded shadow-sm h-100 border border-primary">
                    <i class="fas fa-code fa-4x text-primary mb-3"></i>
                    <h5 class="text-primary">PPLG</h5>
                    <h6 class="text-muted mb-3">Pengembangan Perangkat Lunak dan Gim</h6>
                    <p class="mb-3">Belajar programming, web development, mobile app, dan game development dengan teknologi terkini.</p>
                    <div class="text-start">
                        <small class="text-muted d-block"><i class="fas fa-users me-2"></i>Kuota: 36 siswa</small>
                        <small class="text-muted d-block"><i class="fas fa-clock me-2"></i>Durasi: 3 tahun</small>
                        <small class="text-muted d-block"><i class="fas fa-briefcase me-2"></i>Prospek: Software Developer, Game Developer</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="bg-white text-center p-4 rounded shadow-sm h-100 border border-success">
                    <i class="fas fa-calculator fa-4x text-success mb-3"></i>
                    <h5 class="text-success">AKT</h5>
                    <h6 class="text-muted mb-3">Akuntansi dan Keuangan Lembaga</h6>
                    <p class="mb-3">Menguasai pembukuan, perpajakan, sistem informasi akuntansi, dan manajemen keuangan modern.</p>
                    <div class="text-start">
                        <small class="text-muted d-block"><i class="fas fa-users me-2"></i>Kuota: 36 siswa</small>
                        <small class="text-muted d-block"><i class="fas fa-clock me-2"></i>Durasi: 3 tahun</small>
                        <small class="text-muted d-block"><i class="fas fa-briefcase me-2"></i>Prospek: Akuntan, Staff Keuangan</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="bg-white text-center p-4 rounded shadow-sm h-100 border border-danger">
                    <i class="fas fa-film fa-4x text-danger mb-3"></i>
                    <h5 class="text-danger">ANM</h5>
                    <h6 class="text-muted mb-3">Animasi</h6>
                    <p class="mb-3">Menciptakan karya animasi 2D dan 3D profesional dengan software industry standard seperti Maya, Blender.</p>
                    <div class="text-start">
                        <small class="text-muted d-block"><i class="fas fa-users me-2"></i>Kuota: 36 siswa</small>
                        <small class="text-muted d-block"><i class="fas fa-clock me-2"></i>Durasi: 3 tahun</small>
                        <small class="text-muted d-block"><i class="fas fa-briefcase me-2"></i>Prospek: Animator, Motion Graphics</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.4s">
                <div class="bg-white text-center p-4 rounded shadow-sm h-100 border border-warning">
                    <i class="fas fa-palette fa-4x text-warning mb-3"></i>
                    <h5 class="text-warning">DKV</h5>
                    <h6 class="text-muted mb-3">Desain Komunikasi Visual</h6>
                    <p class="mb-3">Mengembangkan kemampuan desain grafis, branding, dan komunikasi visual berbasis digital.</p>
                    <div class="text-start">
                        <small class="text-muted d-block"><i class="fas fa-users me-2"></i>Kuota: 36 siswa</small>
                        <small class="text-muted d-block"><i class="fas fa-clock me-2"></i>Durasi: 3 tahun</small>
                        <small class="text-muted d-block"><i class="fas fa-briefcase me-2"></i>Prospek: Graphic Designer, UI/UX Designer</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="bg-white text-center p-4 rounded shadow-sm h-100 border border-info">
                    <i class="fas fa-bullhorn fa-4x text-info mb-3"></i>
                    <h5 class="text-info">Pemasaran</h5>
                    <h6 class="text-muted mb-3">Bisnis Digital Pemasaran</h6>
                    <p class="mb-3">Melatih siswa menjadi tenaga profesional dalam strategi promosi, digital marketing, dan kewirausahaan.</p>
                    <div class="text-start">
                        <small class="text-muted d-block"><i class="fas fa-users me-2"></i>Kuota: 36 siswa</small>
                        <small class="text-muted d-block"><i class="fas fa-clock me-2"></i>Durasi: 3 tahun</small>
                        <small class="text-muted d-block"><i class="fas fa-briefcase me-2"></i>Prospek: Digital Marketer, Entrepreneur</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
        <!-- Informasi Tambahan -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-primary wow fadeIn" data-wow-delay="0.1s">
                    <div class="card-body p-4 text-center">
                        <h3 class="text-primary mb-3">Informasi Pendaftaran Jurusan</h3>
                        <p class="mb-3">Pendaftaran jurusan dibuka untuk Tahun Pelajaran 2026-2027. Setiap siswa dapat memilih satu jurusan sesuai minat dan bakat.</p>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="info-box">
                                    <i class="fas fa-calendar-alt fa-2x text-primary mb-2"></i>
                                    <h5>Periode Pendaftaran</h5>
                                    <p class="small">1 Januari - 31 Maret 2026</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-box">
                                    <i class="fas fa-file-alt fa-2x text-primary mb-2"></i>
                                    <h5>Seleksi</h5>
                                    <p class="small">Tes Minat Bakat & Akademik</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-box">
                                    <i class="fas fa-user-graduate fa-2x text-primary mb-2"></i>
                                    <h5>Kuota</h5>
                                    <p class="small">35 Siswa per Jurusan</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('pendaftaran') }}" class="btn btn-primary px-4 py-2 text-white btn-border-radius mt-3">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jurusan End -->

@endsection
