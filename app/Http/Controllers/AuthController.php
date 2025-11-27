<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Pengguna;

class AuthController extends Controller
{


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $pengguna = Pengguna::where('email', $request->email)
                           ->where('aktif', 1)
                           ->first();

        if ($pengguna && Hash::check($request->password, $pengguna->password_hash)) {
            // Clear all existing sessions first
            Session::flush();
            
            // Cek role dan redirect sesuai akses
            if (in_array($pengguna->role, ['admin', 'verifikator_adm', 'keuangan', 'kepsek'])) {
                // Login sebagai staff admin
                Session::put('admin_id', $pengguna->id);
                Session::put('admin_nama', $pengguna->nama);
                Session::put('admin_role', $pengguna->role);
                Session::put('admin_email', $pengguna->email);
                
                // Log aktivitas login
                try {
                    \App\Models\LogAktifitas::create([
                        'user_id' => $pengguna->id,
                        'aksi' => 'Login',
                        'objek' => 'Admin Panel',
                        'objek_data' => [
                            'role' => $pengguna->role,
                            'nama' => $pengguna->nama
                        ],
                        'waktu' => now(),
                        'ip' => $request->ip()
                    ]);
                } catch (\Exception $e) {
                    // Ignore logging errors
                }
                
                $message = $this->getWelcomeMessage($pengguna->role, $pengguna->nama);
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true, 
                        'redirect' => route('admin.dashboard'), 
                        'message' => $message,
                        'role' => $pengguna->role,
                        'user_name' => $pengguna->nama
                    ]);
                }
                return redirect()->route('admin.dashboard')->with('success', $message);
            } else {
                // Login sebagai siswa
                Session::put('siswa_id', $pengguna->id);
                Session::put('siswa_nama', $pengguna->nama);
                Session::put('siswa_email', $pengguna->email);
                
                if ($request->expectsJson()) {
                    return response()->json(['success' => true, 'redirect' => route('pendaftaran')]);
                }
                return redirect()->route('pendaftaran');
            }
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'Email atau password salah'], 401);
        }
        return back()->with('error', 'Email atau password salah. Pastikan Anda menggunakan akun yang benar.');
    }

    public function logout()
    {
        $role = Session::get('admin_role');
        $nama = Session::get('admin_nama');
        
        // Log aktivitas logout
        if (Session::has('admin_id')) {
            try {
                \App\Models\LogAktifitas::create([
                    'user_id' => Session::get('admin_id'),
                    'aksi' => 'Logout',
                    'objek' => 'Admin Panel',
                    'objek_data' => [
                        'role' => $role,
                        'nama' => $nama
                    ],
                    'waktu' => now(),
                    'ip' => request()->ip()
                ]);
            } catch (\Exception $e) {
                // Ignore logging errors during logout
            }
        }
        
        Session::flush();
        return redirect()->route('home')->with('success', 'Anda telah berhasil logout.');
    }
    
    private function getWelcomeMessage($role, $nama)
    {
        $roleNames = [
            'admin' => 'Super Administrator',
            'kepsek' => 'Kepala Sekolah', 
            'verifikator_adm' => 'Verifikator Administrasi',
            'keuangan' => 'Staff Keuangan'
        ];
        
        $roleName = $roleNames[$role] ?? 'Staff';
        return "Selamat datang, {$nama}! Anda login sebagai {$roleName}.";
    }
}