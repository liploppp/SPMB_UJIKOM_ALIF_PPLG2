<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test Email PPDB</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; padding: 20px; border-radius: 8px; }
        .header { text-align: center; border-bottom: 2px solid #007bff; padding-bottom: 20px; margin-bottom: 20px; }
        .content { line-height: 1.6; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; text-align: center; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #007bff; margin: 0;">SMK BAKTI NUSANTARA 666</h2>
            <p style="margin: 5px 0; color: #666;">Penerimaan Peserta Didik Baru (PPDB)</p>
        </div>
        
        <div class="content">
            <h3>Test Email Berhasil!</h3>
            <p>Selamat! Email ini adalah konfirmasi bahwa sistem email PPDB SMK Bakti Nusantara 666 berfungsi dengan baik.</p>
            
            <p><strong>Informasi Test:</strong></p>
            <ul>
                <li>Tanggal: {{ date('d F Y, H:i') }} WIB</li>
                <li>Server: {{ config('mail.host') }}</li>
                <li>From: {{ config('mail.from.address') }}</li>
            </ul>
            
            <p>Sistem email siap digunakan untuk:</p>
            <ul>
                <li>Konfirmasi pendaftaran</li>
                <li>Notifikasi status verifikasi</li>
                <li>Pengumuman hasil seleksi</li>
                <li>Informasi pembayaran</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis oleh sistem PPDB<br>
            SMK Bakti Nusantara 666</p>
        </div>
    </div>
</body>
</html>