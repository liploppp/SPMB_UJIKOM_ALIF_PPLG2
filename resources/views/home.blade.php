@extends('layouts.main')

@section('content')
<!-- Success Modal -->
@if(session('success') && session('no_pendaftaran'))
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body text-center p-5">
                <div class="mb-4">
                    <div class="success-checkmark mx-auto">
                        <div class="check-icon">
                            <span class="icon-line line-tip"></span>
                            <span class="icon-line line-long"></span>
                            <div class="icon-circle"></div>
                            <div class="icon-fix"></div>
                        </div>
                    </div>
                </div>
                <h3 class="text-success mb-3">🎉 Selamat!</h3>
                <h5 class="mb-3">Pendaftaran Berhasil</h5>
                <div class="alert alert-success mb-4">
                    <div class="row text-start">
                        <div class="col-4"><strong>Nama:</strong></div>
                        <div class="col-8">{{ session('nama_siswa') }}</div>
                        <div class="col-4"><strong>Jurusan:</strong></div>
                        <div class="col-8">{{ session('jurusan') }}</div>
                        <div class="col-4"><strong>No. Daftar:</strong></div>
                        <div class="col-8"><span class="h5 text-primary">{{ session('no_pendaftaran') }}</span></div>
                    </div>
                </div>
                <p class="text-muted mb-4">Silakan simpan nomor pendaftaran untuk keperluan selanjutnya.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">OK</button>
                    <a href="/cek-status" class="btn btn-outline-primary px-4">Cek Status</a>
                    <button type="button" class="btn btn-secondary px-4" onclick="copyToClipboard('{{ session('no_pendaftaran') }}')">Salin No. Daftar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(session('success'))
<div class="alert alert-success alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Hero Start -->
<div class="container-fluid py-5 hero-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7 col-md-12">
                <h1 class="mb-3 text-primary">PPDB ONLINE</h1>
                <h1 class="mb-5 display-1 text-white">SMK BAKTI NUSANTARA 666</h1>
                <p class="lead text-white mb-4">Bergabunglah bersama kami untuk meraih masa depan gemilang dengan pendidikan vokasi berkualitas dan siap kerja!</p>
                <a href="{{ route('pendaftaran') }}" class="btn btn-primary px-4 py-3 px-md-5 me-4 btn-border-radius">Daftar Sekarang</a>
                <a href="#program" class="btn btn-outline-light px-4 py-3 px-md-5 btn-border-radius">Lihat Jurusan</a>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- About Start -->
<div class="container-fluid py-5 about bg-light">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="video border">
                    <img src="https://img.youtube.com/vi/RS4HJcIYBOg/maxresdefault.jpg" class="img-fluid rounded" alt="Video SMK BAKTI NUSANTARA 666">
                    <button type="button" class="btn btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/RS4HJcIYBOg" data-bs-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Tentang Kami</h4>
                <h1 class="text-dark mb-4 display-5">SMK BAKTI NUSANTARA 666 - Membangun Masa Depan Cemerlang</h1>
                <p class="text-dark mb-4">SMK BAKTI NUSANTARA 666 adalah sekolah menengah kejuruan unggulan yang berkomitmen mencetak lulusan berkualitas dan siap kerja. Dengan 5 jurusan pilihan: PPLG, Akuntansi, Animasi, DKV, dan Bisnis Digital Pemasaran.
                </p>
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <h6 class="mb-3"><i class="fas fa-check-circle me-2"></i>Fasilitas Modern</h6>
                        <h6 class="mb-3"><i class="fas fa-check-circle me-2 text-primary"></i>Kurikulum Industri</h6>
                        <h6 class="mb-3"><i class="fas fa-check-circle me-2 text-secondary"></i>Sertifikasi Profesi</h6>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="mb-3"><i class="fas fa-check-circle me-2"></i>Lingkungan Aman</h6>
                        <h6 class="mb-3"><i class="fas fa-check-circle me-2 text-primary"></i>Guru Berpengalaman</h6>
                        <h6><i class="fas fa-check-circle me-2 text-secondary"></i>Lulusan Siap Kerja</h6>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="btn btn-primary px-5 py-3 btn-border-radius">More Details</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal Video -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                        allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Service Start -->
<div class="container-fluid service py-5">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Keunggulan Kami</h4>
            <h1 class="mb-5 display-3">Mengapa Memilih SMK BAKTI NUSANTARA 666?</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="text-center border-primary border bg-white service-item h-100">
                    <div class="service-content d-flex align-items-center justify-content-center p-4">
                        <div class="service-content-inner">
                            <div class="p-3"><i class="fas fa-code fa-4x text-primary"></i></div>
                            <h5 class="text-primary">PPLG</h5>
                            <p class="my-3">Pengembangan Perangkat Lunak dan Gim - Belajar programming, web development, dan game development.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.2s">
                <div class="text-center border-primary border bg-white service-item h-100">
                    <div class="service-content d-flex align-items-center justify-content-center p-4">
                        <div class="service-content-inner">
                            <div class="p-3"><i class="fas fa-calculator fa-4x text-success"></i></div>
                            <h5 class="text-success">AKT</h5>
                            <p class="my-3">Akuntansi dan Keuangan Lembaga - Menguasai pembukuan, perpajakan, dan sistem informasi akuntansi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="text-center border-primary border bg-white service-item h-100">
                    <div class="service-content d-flex align-items-center justify-content-center p-4">
                        <div class="service-content-inner">
                            <div class="p-3"><i class="fas fa-film fa-4x text-danger"></i></div>
                            <h5 class="text-danger">ANM</h5>
                            <p class="my-3">Animasi 2D dan 3D - Menciptakan karya animasi profesional dengan software industry standard.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.4s">
                <div class="text-center border-primary border bg-white service-item h-100">
                    <div class="service-content d-flex align-items-center justify-content-center p-4">
                        <div class="service-content-inner">
                            <div class="p-3"><i class="fas fa-palette fa-4x text-warning"></i></div>
                            <h5 class="text-warning">DKV</h5>
                            <p class="my-3">Desain Komunikasi Visual - Mengembangkan kemampuan desain grafis, branding, dan komunikasi visual.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="text-center border-primary border bg-white service-item h-100">
                    <div class="service-content d-flex align-items-center justify-content-center p-4">
                        <div class="service-content-inner">
                            <div class="p-3"><i class="fas fa-bullhorn fa-4x text-info"></i></div>
                            <h5 class="text-info">Pemasaran</h5>
                            <p class="my-3">Pemasaran - Melatih siswa menjadi tenaga profesional dalam strategi promosi dan digital marketing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Programs Start -->
<div class="container-fluid program py-5" id="program">
    <div class="container py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 700px;">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">Program Keahlian</h4>
            <h1 class="mb-5 display-3">SMK BAKTI NUSANTARA 666</h1>
            <p class="mb-4">Kami menawarkan 5 program keahlian unggulan yang sesuai dengan kebutuhan industri modern</p>
        </div>
        <div class="row g-5 justify-content-center">
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.1s">
                <div class="program-item rounded">
                    <div class="program-img position-relative bg-gradient-primary d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                        <div class="text-center">
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-code fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-primary text-white program-rate shadow">PPLG</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Pengembangan Perangkat Lunak dan Gim</a>
                            <p class="mt-3 mb-0">Belajar programming, web development, mobile app development, dan game development dengan teknologi terkini.</p>
                        </div>
                    </div>
                    <div class="program-teacher d-flex align-items-center border-top border-primary bg-white px-4 py-3">
                        <img src="{{ asset('img/program-teacher.jpg') }}" class="img-fluid rounded-circle p-2 border border-primary bg-white" alt="Image" style="width: 70px; height: 70px;">
                        <div class="ms-3">
                            <h6 class="mb-0 text-primary">Pak Budi</h6>
                            <small>Guru PPLG</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-primary rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-book me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="program-item rounded">
                    <div class="program-img position-relative bg-gradient-success d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);">
                        <div class="text-center">
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-calculator fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-success text-white program-rate shadow">AKT</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Akuntansi dan Keuangan Lembaga</a>
                            <p class="mt-3 mb-0">Menguasai pembukuan, perpajakan, sistem informasi akuntansi, dan manajemen keuangan modern.</p>
                        </div>
                    </div>
                    <div class="program-teacher d-flex align-items-center border-top border-primary bg-white px-4 py-3">
                        <img src="{{ asset('img/program-teacher.jpg') }}" class="img-fluid rounded-circle p-2 border border-primary bg-white" alt="" style="width: 70px; height: 70px;">
                        <div class="ms-3">
                            <h6 class="mb-0 text-primary">Bu Sari</h6>
                            <small>Guru AKT</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-success rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-book me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.5s">
                <div class="program-item rounded">
                    <div class="program-img position-relative bg-gradient-danger d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #dc3545 0%, #bd2130 100%);">
                        <div class="text-center">
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-film fa-2x text-danger"></i>
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-danger text-white program-rate shadow">ANM</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Animasi</a>
                            <p class="mt-3 mb-0">Menciptakan karya animasi 2D dan 3D profesional dengan software industry standard seperti Maya, Blender.</p>
                        </div>
                    </div>
                    <div class="program-teacher d-flex align-items-center border-top border-primary bg-white px-4 py-3">
                        <img src="{{ asset('img/program-teacher.jpg') }}" class="img-fluid rounded-circle p-2 border border-primary bg-white" alt="" style="width: 70px; height: 70px;">
                        <div class="ms-3">
                            <h6 class="mb-0 text-primary">Pak Andi</h6>
                            <small>Guru ANM</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-danger rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-book me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.7s">
                <div class="program-item rounded">
                    <div class="program-img position-relative bg-gradient-warning d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                        <div class="text-center">
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-palette fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-warning text-white program-rate shadow">DKV</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Desain Komunikasi Visual</a>
                            <p class="mt-3 mb-0">Mengembangkan kemampuan desain grafis, branding, dan komunikasi visual berbasis digital.</p>
                        </div>
                    </div>
                    <div class="program-teacher d-flex align-items-center border-top border-primary bg-white px-4 py-3">
                        <img src="{{ asset('img/program-teacher.jpg') }}" class="img-fluid rounded-circle p-2 border border-primary bg-white" alt="" style="width: 70px; height: 70px;">
                        <div class="ms-3">
                            <h6 class="mb-0 text-primary">Bu Maya</h6>
                            <small>Guru DKV</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-warning rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-book me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeIn" data-wow-delay="0.9s">
                <div class="program-item rounded">
                    <div class="program-img position-relative bg-gradient-info d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);">
                        <div class="text-center">
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-bullhorn fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-info text-white program-rate shadow">BDP</div>
                    </div>
                    <div class="program-text bg-white px-4 pb-3">
                        <div class="program-text-inner">
                            <a href="#" class="h4">Bisnis Digital Pemasaran</a>
                            <p class="mt-3 mb-0">Melatih siswa menjadi tenaga profesional dalam strategi promosi, digital marketing, dan kewirausahaan.</p>
                        </div>
                    </div>
                    <div class="program-teacher d-flex align-items-center border-top border-primary bg-white px-4 py-3">
                        <img src="{{ asset('img/program-teacher.jpg') }}" class="img-fluid rounded-circle p-2 border border-primary bg-white" alt="" style="width: 70px; height: 70px;">
                        <div class="ms-3">
                            <h6 class="mb-0 text-primary">Pak Dedi</h6>
                            <small>Guru BDP</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between px-4 py-2 bg-info rounded-bottom">
                        <small class="text-white"><i class="fas fa-users me-1"></i> 36 Siswa</small>
                        <small class="text-white"><i class="fas fa-book me-1"></i> 3 Tahun</small>
                        <small class="text-white"><i class="fas fa-certificate me-1"></i> Sertifikat</small>
                    </div>
                </div>
            </div>
            <div class="d-inline-block text-center wow fadeIn" data-wow-delay="1.1s">
                <a href="{{ route('pendaftaran') }}" class="btn btn-primary px-5 py-3 text-white btn-border-radius">Daftar Sekarang</a>
            </div>
        </div> 
    </div>
</div>
<!-- Program End -->

<!-- CTA Start -->
<div class="container-fluid py-5 bg-primary">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-8 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="text-white mb-4 display-4">Segera Daftarkan Diri Anda!</h1>
                <p class="text-white mb-0">Jangan lewatkan kesempatan bergabung dengan SMK BAKTI NUSANTARA 666. Raih masa depan gemilang dengan pendidikan vokasi berkualitas!</p>
            </div>
            <div class="col-lg-4 text-lg-end wow fadeIn" data-wow-delay="0.3s">
                <a href="{{ route('pendaftaran') }}" class="btn btn-light px-5 py-3 btn-border-radius">Daftar Sekarang</a>
                <a href="{{ route('jurusan') }}" class="btn btn-outline-light px-5 py-3 btn-border-radius ms-2">Info Jurusan</a>
            </div>
        </div>
    </div>
</div>
<!-- CTA End -->

<!-- Success Modal Styles -->
<style>
.success-checkmark {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #4bb71b;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #4bb71b;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    position: relative;
    margin: 0 auto;
}

.success-checkmark .check-icon {
    width: 56px;
    height: 56px;
    position: absolute;
    left: 12px;
    top: 12px;
    z-index: 1;
    border-radius: 50%;
    background: #4bb71b;
}

.success-checkmark .check-icon::before {
    content: '';
    width: 30px;
    height: 30px;
    position: absolute;
    left: 13px;
    top: 13px;
    border-radius: 50%;
    background: white;
}

.success-checkmark .icon-line {
    height: 2px;
    background: white;
    display: block;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
}

.success-checkmark .icon-line.line-tip {
    top: 27px;
    left: 14px;
    width: 10px;
    transform: rotate(45deg);
    animation: icon-line-tip .75s;
}

.success-checkmark .icon-line.line-long {
    top: 24px;
    right: 8px;
    width: 18px;
    transform: rotate(-45deg);
    animation: icon-line-long .75s;
}

.success-checkmark .icon-circle {
    top: -1px;
    left: -1px;
    z-index: 10;
    width: 82px;
    height: 82px;
    border-radius: 50%;
    position: absolute;
    box-sizing: border-box;
    border: 2px solid #4bb71b;
}

.success-checkmark .icon-fix {
    top: 10px;
    width: 5px;
    left: 28px;
    z-index: 1;
    height: 85px;
    position: absolute;
    transform: rotate(-45deg);
    background-color: white;
}

@keyframes icon-line-tip {
    0% { width: 0; left: 1px; top: 19px; }
    54% { width: 0; left: 1px; top: 19px; }
    70% { width: 10px; left: 14px; top: 27px; }
    84% { width: 17px; left: 21px; top: 48px; }
    100% { width: 10px; left: 14px; top: 27px; }
}

@keyframes icon-line-long {
    0% { width: 0; right: 46px; top: 54px; }
    65% { width: 0; right: 46px; top: 54px; }
    84% { width: 55px; right: 0px; top: 35px; }
    100% { width: 18px; right: 8px; top: 24px; }
}

@keyframes fill {
    100% { box-shadow: inset 0px 0px 0px 60px #4bb71b; }
}

@keyframes scale {
    0%, 100% { transform: none; }
    50% { transform: scale3d(1.1, 1.1, 1); }
}
</style>

<!-- Auto show success modal -->
@if(session('success'))
<script src="{{ asset('js/notifications.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('no_pendaftaran'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            
            // Add confetti effect
            setTimeout(() => {
                if (typeof confetti !== 'undefined') {
                    confetti({
                        particleCount: 100,
                        spread: 70,
                        origin: { y: 0.6 }
                    });
                }
            }, 500);
        @endif
    });
    
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            showNotification('Nomor pendaftaran berhasil disalin!', 'success', 2000);
        }).catch(function() {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showNotification('Nomor pendaftaran berhasil disalin!', 'success', 2000);
        });
    }
</script>
@endif

@endsection