@extends('layouts.main')

@section('content')
<!-- Hero Start -->
<div class="container-fluid py-5 hero-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7 col-md-12">
                <h1 class="mb-3 text-primary">Selamat Datang di</h1>
                <h1 class="mb-5 display-1 text-white">SMK BAKTI NUSANTARA 666</h1>
                <p class="text-white mb-4">Sekolah Menengah Kejuruan unggulan dengan 5 program keahlian: PPLG, AKT, ANM, DKV, dan BDP. Siap mencetak lulusan berkualitas dan siap kerja.</p>
                <a href="{{ route('pendaftaran') }}" class="btn btn-primary px-4 py-3 px-md-5 me-4 btn-border-radius">Daftar Sekarang</a>
                <a href="{{ route('jurusan') }}" class="btn btn-primary px-4 py-3 px-md-5 btn-border-radius">Lihat Jurusan</a>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->
@endsection