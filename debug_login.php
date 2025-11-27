<?php

// Script untuk debug masalah login
echo "=== DEBUG LOGIN PROBLEM ===\n\n";

// Simulasi koneksi database sederhana
$host = '127.0.0.1';
$dbname = 'ppdb_alif';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Koneksi database berhasil\n\n";
    
    // Cek tabel penggunas
    $stmt = $pdo->query("SELECT id, nama, email, role, aktif FROM penggunas");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Data pengguna di database:\n";
    echo "==========================\n";
    
    if (empty($users)) {
        echo "❌ Tidak ada data pengguna di database!\n";
        echo "Solusi: Jalankan seeder dengan perintah: php artisan db:seed --class=AdminSeeder\n\n";
    } else {
        foreach ($users as $user) {
            echo "ID: {$user['id']}\n";
            echo "Nama: {$user['nama']}\n";
            echo "Email: {$user['email']}\n";
            echo "Role: {$user['role']}\n";
            echo "Aktif: " . ($user['aktif'] ? 'Ya' : 'Tidak') . "\n";
            echo "---\n";
        }
    }
    
    // Cek role yang valid menurut AuthController
    $validRoles = ['admin', 'verifikator', 'keuangan', 'kepala_sekolah'];
    echo "\nRole yang valid untuk login admin:\n";
    foreach ($validRoles as $role) {
        echo "- $role\n";
    }
    
    echo "\nAnalisis masalah:\n";
    echo "=================\n";
    
    $problemUsers = [];
    foreach ($users as $user) {
        if (!in_array($user['role'], $validRoles) && $user['role'] !== 'pendaftar') {
            $problemUsers[] = $user;
        }
    }
    
    if (!empty($problemUsers)) {
        echo "❌ Ditemukan pengguna dengan role yang tidak valid:\n";
        foreach ($problemUsers as $user) {
            echo "- {$user['nama']} ({$user['email']}) memiliki role: {$user['role']}\n";
        }
    } else {
        echo "✓ Semua role pengguna sudah valid\n";
    }
    
    // Test password hash
    echo "\nTest password hash:\n";
    echo "===================\n";
    
    $testPasswords = [
        'admin123' => '$2y$12$9HkI8yxvBBRhp8ngIKU5kJ7WIOral7nE3bKrEvZARtQ=',
        'kepsek123' => '$2y$12$9HkI8yxvBBRhp8ngIKU5kJ7WIOral7nE3bKrEvZARtQ=',
        'verifikator123' => '$2y$12$9HkI8yxvBBRhp8ngIKU5kJ7WIOral7nE3bKrEvZARtQ=',
        'keuangan123' => '$2y$12$9HkI8yxvBBRhp8ngIKU5kJ7WIOral7nE3bKrEvZARtQ='
    ];
    
    foreach ($testPasswords as $password => $hash) {
        $isValid = password_verify($password, $hash);
        echo "Password '$password': " . ($isValid ? '✓ Valid' : '❌ Invalid') . "\n";
    }
    
    echo "\n=== SOLUSI ===\n";
    echo "1. Pastikan database memiliki data pengguna\n";
    echo "2. Jalankan: php artisan db:seed --class=AdminSeeder\n";
    echo "3. Atau jalankan file: fix_login_problem.bat\n";
    echo "4. Gunakan credentials:\n";
    echo "   - Admin: admin@smkbaktinusantara.sch.id / admin123\n";
    echo "   - Kepala Sekolah: kepsek@smkbaktinusantara.sch.id / kepsek123\n";
    echo "   - Verifikator: verifikator@smkbaktinusantara.sch.id / verifikator123\n";
    echo "   - Keuangan: keuangan@smkbaktinusantara.sch.id / keuangan123\n";
    
} catch (PDOException $e) {
    echo "❌ Error koneksi database: " . $e->getMessage() . "\n";
    echo "Pastikan:\n";
    echo "1. MySQL/MariaDB sudah berjalan\n";
    echo "2. Database 'ppdb_alif' sudah dibuat\n";
    echo "3. Credentials database di .env sudah benar\n";
}