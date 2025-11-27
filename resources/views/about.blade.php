@extends('layouts.main')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-white mb-4">Tentang Kami</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#">Halaman</a></li>
                <li class="breadcrumb-item text-white" aria-current="page">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Tentang Sekolah Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <img src="{{ asset('img/bn.jpg') }}" class="img-fluid rounded shadow" alt="SMK Bakti Nusantara 666">
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                    Tentang Sekolah Kami
                </h4>
                <h1 class="text-dark mb-4 display-5">SMK BAKTI NUSANTARA 666 – Sekolah Pusat Keunggulan</h1>
                <p class="text-dark mb-3">
                    Berdiri sejak tahun <strong>2007</strong>, SMK BAKTI NUSANTARA 666 telah menjadi salah satu sekolah kejuruan unggulan di wilayah Bandung.
                    Dengan jumlah siswa yang telah mencapai lebih dari <strong>20.000 alumni</strong>, kami terus berkomitmen mencetak generasi muda yang berkarakter, kompeten, dan siap bersaing di dunia kerja maupun perguruan tinggi.
                </p>
                <p class="text-dark mb-4">
                    Sebagai bagian dari program <strong>Sekolah Pusat Keunggulan (PK)</strong> dari Kementerian Pendidikan, kami menerapkan sistem pembelajaran berbasis industri dengan fasilitas modern serta didukung oleh tenaga pendidik profesional.
                </p>
                <a href="{{ route('jurusan') }}" class="btn btn-primary px-5 py-3 btn-border-radius">Lihat Jurusan</a>
            </div>
        </div>
    </div>
</div>
<!-- Tentang Sekolah End -->

<!-- Fasilitas Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeIn" data-wow-delay="0.1s">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                Fasilitas Sekolah
            </h4>
            <h1 class="text-dark mb-4 display-5">Fasilitas Modern & Lengkap</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="bg-white text-center p-4 rounded shadow-sm h-100">
                    <i class="fas fa-desktop fa-3x text-primary mb-3"></i>
                    <h5>Laboratorium Komputer</h5>
                    <p>Dilengkapi perangkat modern untuk mendukung pembelajaran berbasis teknologi.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="bg-white text-center p-4 rounded shadow-sm h-100">
                    <i class="fas fa-network-wired fa-3x text-success mb-3"></i>
                    <h5>Ruang Jaringan & Server</h5>
                    <p>Tempat praktik siswa jurusan PPLG dan Jaringan untuk simulasi dunia industri.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.4s">
                <div class="bg-white text-center p-4 rounded shadow-sm h-100">
                    <i class="fas fa-book fa-3x text-danger mb-3"></i>
                    <h5>Perpustakaan Digital</h5>
                    <p>Berisi ribuan buku fisik dan e-book untuk menunjang pembelajaran mandiri.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="bg-white text-center p-4 rounded shadow-sm h-100">
                    <i class="fas fa-futbol fa-3x text-warning mb-3"></i>
                    <h5>Lapangan & Area Olahraga</h5>
                    <p>Mendukung kesehatan dan kegiatan ekstrakurikuler siswa di berbagai bidang olahraga.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fasilitas End -->

<!-- Prestasi Start -->
<div id="prestasi" class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5 wow fadeIn" data-wow-delay="0.1s">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                Prestasi Sekolah
            </h4>
            <h1 class="text-dark mb-4 display-5">Prestasi & Penghargaan SMK BAKTI NUSANTARA 666</h1>
        </div>
        <div class="row g-4">
            <div class="col-md-4 wow fadeIn" data-wow-delay="0.2s">
                <div class="bg-white p-4 text-center shadow-sm rounded h-100">
                    <i class="fas fa-trophy fa-3x text-warning mb-3"></i>
                    <h5>Juara 1 LKS Provinsi Jawa Barat</h5>
                    <p>Bidang Rekayasa Perangkat Lunak (RPL) – Tahun 2024.</p>
                </div>
            </div>
            <div class="col-md-4 wow fadeIn" data-wow-delay="0.4s">
                <div class="bg-white p-4 text-center shadow-sm rounded h-100">
                    <i class="fas fa-medal fa-3x text-primary mb-3"></i>
                    <h5>Juara Nasional Animasi Siswa SMK</h5>
                    <p>Tim Animasi berhasil menjuarai kompetisi tingkat nasional tahun 2023.</p>
                </div>
            </div>
            <div class="col-md-4 wow fadeIn" data-wow-delay="0.6s">
                <div class="bg-white p-4 text-center shadow-sm rounded h-100">
                    <i class="fas fa-award fa-3x text-success mb-3"></i>
                    <h5>Sekolah Pusat Keunggulan</h5>
                    <p>Terpilih sebagai Sekolah Pusat Keunggulan (PK) oleh Kemendikbud tahun 2023.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Prestasi End -->
@endsection
