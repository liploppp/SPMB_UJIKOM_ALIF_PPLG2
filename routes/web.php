<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CalonSiswaAuthController;

// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/jurusan', [HomeController::class, 'jurusan'])->name('jurusan');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Pendaftaran routes
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
Route::get('/ppdb/form', [PendaftaranController::class, 'index'])->name('ppdb.form');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store')->middleware('siswa.auth');
Route::post('/ppdb/submit', [PendaftaranController::class, 'store'])->name('ppdb.submit')->middleware('siswa.auth');

// Other pages
Route::get('/event', [EventController::class, 'index'])->name('event');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.detail');
Route::get('/team', [TeamController::class, 'index'])->name('team');
Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/program', [HomeController::class, 'program'])->name('program');

// Auth Pages  
Route::get('/login', function() { return view('auth.login'); })->name('auth.login');
Route::get('/register', function() { return view('auth.register'); })->name('auth.register');

// Calon Siswa Authentication
Route::post('/siswa/login', [CalonSiswaAuthController::class, 'login'])->name('siswa.login');
Route::post('/siswa/register', [CalonSiswaAuthController::class, 'register'])->name('siswa.register');
Route::post('/siswa/verify-otp', [CalonSiswaAuthController::class, 'verifyOtp'])->name('siswa.verify-otp');
Route::get('/siswa/logout', [CalonSiswaAuthController::class, 'logout'])->name('siswa.logout');

// Siswa Dashboard
Route::middleware('siswa.auth')->group(function () {
    Route::get('/siswa/dashboard', [\App\Http\Controllers\SiswaDashboardController::class, 'index'])->name('siswa.dashboard');
    Route::get('/siswa/cetak-bukti', [\App\Http\Controllers\SiswaDashboardController::class, 'cetakBukti'])->name('siswa.cetak-bukti');
    
    // Upload Ulang Berkas Routes
    Route::get('/upload-berkas', [PendaftaranController::class, 'uploadBerkasForm'])->name('ppdb.upload-berkas-form');
    Route::post('/upload-berkas', [PendaftaranController::class, 'uploadBerkas'])->name('ppdb.upload-berkas');
    
    // Pembayaran Routes
    Route::get('/pembayaran', [\App\Http\Controllers\PembayaranController::class, 'index'])->name('pembayaran');
    Route::post('/pembayaran', [\App\Http\Controllers\PembayaranController::class, 'store'])->name('pembayaran.store');
});

// Cek Status Routes
Route::get('/cek-status', [\App\Http\Controllers\CekStatusController::class, 'index'])->name('cek-status');
Route::get('/cetak-bukti-pendaftaran/{id}', [\App\Http\Controllers\CekStatusController::class, 'cetakBukti']);

// File Routes
Route::get('/storage/berkas/{filename}', [\App\Http\Controllers\FileController::class, 'show'])->name('file.show');
Route::get('/file/{filename}', [\App\Http\Controllers\FileController::class, 'show'])->name('file.direct');

// Test Email Routes
Route::get('/test-email', [\App\Http\Controllers\TestEmailController::class, 'testPage']);
Route::get('/test-email/send', [\App\Http\Controllers\TestEmailController::class, 'sendTest']);

// Admin Authentication  
Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->group(function () {
    
    // Protected admin routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Data Master Routes (Admin only)
        Route::middleware('admin.auth:admin')->group(function () {
            Route::resource('jurusan', \App\Http\Controllers\Admin\DataMaster\JurusanController::class, ['as' => 'admin']);
            Route::resource('gelombang', \App\Http\Controllers\Admin\DataMaster\GelombangController::class, ['as' => 'admin']);
            Route::get('wilayah', [\App\Http\Controllers\Admin\DataMaster\WilayahController::class, 'index'])->name('admin.wilayah.index');
            Route::get('wilayah/{wilayah}/edit', [\App\Http\Controllers\Admin\DataMaster\WilayahController::class, 'edit'])->name('admin.wilayah.edit');
            Route::put('wilayah/{wilayah}', [\App\Http\Controllers\Admin\DataMaster\WilayahController::class, 'update'])->name('admin.wilayah.update');
            Route::delete('wilayah/{wilayah}', [\App\Http\Controllers\Admin\DataMaster\WilayahController::class, 'destroy'])->name('admin.wilayah.destroy');
            Route::resource('pengguna', \App\Http\Controllers\Admin\DataMaster\PenggunaController::class, ['as' => 'admin']);
        });
        
        // Pendaftar Routes
        Route::get('pendaftar', [\App\Http\Controllers\Admin\PendaftarController::class, 'index'])->name('admin.pendaftar.index');
        Route::get('pendaftar/{id}', [\App\Http\Controllers\Admin\PendaftarController::class, 'show'])->name('admin.pendaftar.show');
        Route::patch('pendaftar/{id}/status', [\App\Http\Controllers\Admin\PendaftarController::class, 'updateStatus'])->name('admin.pendaftar.updateStatus');
        Route::delete('pendaftar/{id}', [\App\Http\Controllers\Admin\PendaftarController::class, 'destroy'])->name('admin.pendaftar.destroy');
        
        // Berkas validation route
        Route::post('berkas/{id}/validate', [\App\Http\Controllers\FileController::class, 'validateBerkas'])->name('admin.berkas.validate');
        
        // Reports Routes (Kepala Sekolah)
        Route::get('reports/dashboard', [\App\Http\Controllers\ReportController::class, 'dashboard'])->name('admin.reports.dashboard');
        Route::get('reports/export', [\App\Http\Controllers\ReportController::class, 'exportExcel'])->name('admin.reports.export');
        
        // Monitoring Routes (Kepala Sekolah)
        Route::get('monitoring/asal-wilayah', [\App\Http\Controllers\Admin\MonitoringController::class, 'asalWilayah'])->name('admin.monitoring.asal-wilayah');
        Route::get('monitoring/asal-sekolah', [\App\Http\Controllers\Admin\MonitoringController::class, 'asalSekolah'])->name('admin.monitoring.asal-sekolah');
        Route::get('monitoring/siswa-diterima', [\App\Http\Controllers\Admin\MonitoringController::class, 'siswaDiterima'])->name('admin.monitoring.diterima');
        
        // Verifikator Routes
        Route::get('verifikator', [\App\Http\Controllers\Admin\VerifikatorController::class, 'index'])->name('admin.verifikator.index');
        Route::get('verifikator/{id}', [\App\Http\Controllers\Admin\VerifikatorController::class, 'show'])->name('admin.verifikator.show');
        Route::patch('verifikator/{id}/status', [\App\Http\Controllers\Admin\VerifikatorController::class, 'updateStatus'])->name('admin.verifikator.updateStatus');
        Route::post('verifikator/bulk', [\App\Http\Controllers\Admin\VerifikatorController::class, 'bulkAction'])->name('admin.verifikator.bulk');
        
        // Pembayaran Routes (Keuangan & Admin)
        Route::get('pembayaran', [\App\Http\Controllers\Admin\PembayaranController::class, 'index'])->name('admin.pembayaran.index');
        Route::get('pembayaran/{id}', [\App\Http\Controllers\Admin\PembayaranController::class, 'show'])->name('admin.pembayaran.show');
        Route::patch('pembayaran/{id}/verifikasi', [\App\Http\Controllers\Admin\PembayaranController::class, 'verifikasi'])->name('admin.pembayaran.verifikasi');
        Route::delete('pembayaran/{id}', [\App\Http\Controllers\Admin\PembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');
        Route::get('pembayaran/{id}/bukti-digital', [\App\Http\Controllers\Admin\PembayaranController::class, 'buktiDigital'])->name('admin.pembayaran.bukti');
        Route::get('pembayaran/{id}/cetak-bukti', [\App\Http\Controllers\Admin\PembayaranController::class, 'cetakBukti'])->name('admin.pembayaran.cetak-bukti');
        
        // Keuangan Routes
        Route::get('keuangan/rekap', [\App\Http\Controllers\Admin\KeuanganController::class, 'rekap'])->name('admin.keuangan.rekap');
        Route::get('keuangan/daftar', [\App\Http\Controllers\Admin\KeuanganController::class, 'daftar'])->name('admin.keuangan.daftar');
        Route::post('pembayaran/bulk-verifikasi', [\App\Http\Controllers\Admin\KeuanganController::class, 'bulkVerifikasi'])->name('admin.pembayaran.bulk-verifikasi');
        
        // Log Aktivitas Routes (Super Admin only)
        Route::middleware('admin.auth:admin')->group(function () {
            Route::get('log-aktivitas', [\App\Http\Controllers\Admin\LogAktifitasController::class, 'index'])->name('admin.log-aktivitas.index');
        });
    });
});
