<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Pengguna;
use App\Models\OtpVerification;
use App\Mail\OtpEmail;

class CalonSiswaAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $pengguna = Pengguna::where('email', $request->email)
                           ->where('aktif', 1)
                           ->where('role', 'pendaftar') // Only allow pendaftar role
                           ->first();

        if ($pengguna && Hash::check($request->password, $pengguna->password_hash)) {
            Session::put('siswa_id', $pengguna->id);
            Session::put('siswa_nama', $pengguna->nama);
            Session::put('siswa_email', $pengguna->email);
            Session::put('siswa_role', $pengguna->role);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil! Selamat datang, ' . $pengguna->nama,
                    'redirect' => route('home'),
                    'role' => $pengguna->role,
                    'user_name' => $pengguna->nama
                ]);
            }
            
            return redirect()->route('home')->with('login_success', [
                'user_name' => $pengguna->nama,
                'role' => $pengguna->role
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }
        
        return back()->with('error', 'Email atau password salah. Pastikan Anda sudah terdaftar sebagai calon siswa.');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required|string|max:100',
                'email' => 'required|email|unique:penggunas,email',
                'no_hp' => 'required|string|max:20',
                'password' => 'required|min:6|confirmed'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            if ($errors->has('email')) {
                return back()->with('error', 'Email sudah terdaftar. Silakan gunakan email lain atau login jika sudah memiliki akun.');
            }
            if ($errors->has('password')) {
                return back()->with('error', 'Password minimal 6 karakter dan konfirmasi password harus sama.');
            }
            return back()->with('error', 'Data yang dimasukkan tidak valid. Silakan periksa kembali.');
        }

        // Generate OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Simpan data registrasi sementara di session
        Session::put('temp_register', [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'hp' => $request->no_hp,
            'password_hash' => Hash::make($request->password),
            'role' => 'pendaftar',
            'aktif' => 1
        ]);
        
        // Hapus OTP lama untuk email ini
        OtpVerification::where('email', $request->email)->delete();
        
        // Simpan OTP baru
        OtpVerification::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
            'is_verified' => false
        ]);
        
        // Kirim email OTP
        try {
            Mail::to($request->email)->send(new OtpEmail($otp, $request->nama_lengkap));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email OTP. Silakan coba lagi.');
        }
        
        Session::put('show_otp', true);
        Session::put('otp_email', $request->email);
        
        return back()->with('success', 'Kode OTP telah dikirim ke email Anda. Silakan cek email dan masukkan kode OTP.');
    }
    
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string|size:6'
        ]);
        
        $email = Session::get('otp_email');
        if (!$email) {
            return back()->with('error', 'Session OTP tidak ditemukan. Silakan daftar ulang.');
        }
        
        $otpRecord = OtpVerification::where('email', $email)
                                   ->where('otp', $request->otp_code)
                                   ->where('is_verified', false)
                                   ->first();
        
        if (!$otpRecord) {
            return back()->with('error', 'Kode OTP tidak valid');
        }
        
        if ($otpRecord->isExpired()) {
            return back()->with('error', 'Kode OTP sudah kedaluwarsa');
        }
        
        // Ambil data registrasi dari session
        $tempData = Session::get('temp_register');
        if (!$tempData || $tempData['email'] !== $email) {
            return back()->with('error', 'Data registrasi tidak ditemukan');
        }
        
        // Buat akun pengguna
        $pengguna = Pengguna::create([
            'nama' => $tempData['nama_lengkap'],
            'email' => $tempData['email'],
            'hp' => $tempData['hp'],
            'password_hash' => $tempData['password_hash'],
            'role' => $tempData['role'],
            'aktif' => $tempData['aktif']
        ]);
        
        // Mark OTP as verified
        $otpRecord->update(['is_verified' => true]);
        
        // Auto login
        Session::put('siswa_id', $pengguna->id);
        Session::put('siswa_nama', $pengguna->nama);
        Session::put('siswa_email', $pengguna->email);
        
        // Hapus data temp
        Session::forget(['temp_register', 'show_otp', 'otp_email']);
        
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil! Anda sudah login.',
                'user_name' => $pengguna->nama,
                'role' => 'pendaftar'
            ]);
        }
        
        return redirect()->route('home')->with('login_success', [
            'user_name' => $pengguna->nama,
            'role' => 'pendaftar'
        ]);
    }

    public function logout()
    {
        Session::forget(['siswa_id', 'siswa_nama', 'siswa_email']);
        return redirect()->route('home');
    }
}