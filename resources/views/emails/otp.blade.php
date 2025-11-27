<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode OTP Registrasi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { color: #ff4880; font-size: 24px; font-weight: bold; }
        .otp-code { font-size: 32px; font-weight: bold; color: #ff4880; text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px; margin: 20px 0; letter-spacing: 5px; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">SMK BAKTINUSANTARA 666</div>
            <h2>Kode OTP Registrasi</h2>
        </div>
        
        <p>Halo {{ $nama ?? 'Calon Siswa' }},</p>
        
        <p>Terima kasih telah mendaftar di sistem PPDB SMK Baktinusantara 666. Untuk melanjutkan proses registrasi, silakan masukkan kode OTP berikut:</p>
        
        <div class="otp-code">{{ $otp }}</div>
        
        <p><strong>Kode OTP ini berlaku selama 10 menit.</strong></p>
        
        <p>Jika Anda tidak melakukan registrasi, abaikan email ini.</p>
        
        <div class="footer">
            <p>Email otomatis dari Panitia PPDB SMK Baktinusantara 666</p>
        </div>
    </div>
</body>
</html>