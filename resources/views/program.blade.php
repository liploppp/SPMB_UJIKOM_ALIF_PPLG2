@extends('layouts.main')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4">Program Keahlian</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Program</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Program Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeIn" data-wow-delay="0.1s">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                Program Unggulan
            </h4>
            <h1 class="text-dark mb-4 display-5">SMK BAKTI NUSANTARA 666</h1>
            <p class="mb-4">Kami menawarkan 5 program keahlian unggulan yang sesuai dengan kebutuhan industri modern</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.2s">
                <div class="program-item rounded h-100">
                    <div class="program-img position-relative">
                        <div class="overflow-hidden img-border-radius">
                            <img src="{{ asset('img/program-1.jpg') }}" class="img-fluid w-100" alt="PPLG">
                        </div>
                        <div class="px-4 py-2 bg-primary text-white program-rate">PPLG</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Pengembangan Perangkat Lunak dan Gim</a>
                            <p class="mt-3 mb-0">Belajar programming, web development, mobile app development, dan game development dengan teknologi terkini.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-primary rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-clock me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.4s">
                <div class="program-item rounded h-100">
                    <div class="program-img position-relative">
                        <div class="overflow-hidden img-border-radius">
                            <img src="{{ asset('img/program-2.jpg') }}" class="img-fluid w-100" alt="AKT">
                        </div>
                        <div class="px-4 py-2 bg-success text-white program-rate">AKT</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Akuntansi dan Keuangan Lembaga</a>
                            <p class="mt-3 mb-0">Menguasai pembukuan, perpajakan, sistem informasi akuntansi, dan manajemen keuangan modern.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-success rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-clock me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.6s">
                <div class="program-item rounded h-100">
                    <div class="program-img position-relative">
                        <div class="overflow-hidden img-border-radius">
                            <img src="{{ asset('img/program-3.jpg') }}" class="img-fluid w-100" alt="ANM">
                        </div>
                        <div class="px-4 py-2 bg-danger text-white program-rate">ANM</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Animasi</a>
                            <p class="mt-3 mb-0">Menciptakan karya animasi 2D dan 3D profesional dengan software industry standard seperti Maya, Blender.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-danger rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-clock me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.8s">
                <div class="program-item rounded h-100">
                    <div class="program-img position-relative">
                        <div class="overflow-hidden img-border-radius">
                            <img src="{{ asset('img/program-1.jpg') }}" class="img-fluid w-100" alt="DKV">
                        </div>
                        <div class="px-4 py-2 bg-warning text-white program-rate">DKV</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Desain Komunikasi Visual</a>
                            <p class="mt-3 mb-0">Mengembangkan kemampuan desain grafis, branding, dan komunikasi visual berbasis digital.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-warning rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-clock me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="1.0s">
                <div class="program-item rounded h-100">
                    <div class="program-img position-relative">
                        <div class="overflow-hidden img-border-radius">
                            <img src="{{ asset('img/program-2.jpg') }}" class="img-fluid w-100" alt="BDP">
                        </div>
                        <div class="px-4 py-2 bg-info text-white program-rate">BDP</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Bisnis Digital Pemasaran</a>
                            <p class="mt-3 mb-0">Melatih siswa menjadi tenaga profesional dalam strategi promosi, digital marketing, dan kewirausahaan.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-info rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-clock me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('pendaftaran') }}" class="btn btn-primary px-5 py-3 text-white btn-border-radius">Daftar Sekarang</a>
        </div>
    </div>
</div>
<!-- Program End -->
@endsection